import '@algolia/autocomplete-theme-classic';
import './theme.css';
import { autocomplete,getAlgoliaResults} from '@algolia/autocomplete-js';
import algoliasearch from 'algoliasearch/lite';
import { createLocalStorageRecentSearchesPlugin } from '@algolia/autocomplete-plugin-recent-searches';
import categorySearch from './search/category'


let appID = BC.search.app_id;
let apiKey = BC.search.public_key;
let wrap = document.getElementById('bc_autocomplete');

const searchClient = algoliasearch(
    appID,
    apiKey
);
const recentSearchesPlugin = createLocalStorageRecentSearchesPlugin({
    key: 'instantsearch',
    limit: 5,
    transformSource({source}){
        return {
            ...source,
            getItemUrl({item}) {
                return BC.url+'/product?s='+item.label
            },
            templates: {
                item(params) {
                    const { item, html } = params;

                    return html`<a class="aa-ItemLink" href="${BC.url}/product?s=${item.label}">
                        ${source.templates.item(params).props.children}
                      </a>`;
                },
            },
        }
    }
});
autocomplete({
    container: wrap,
    placeholder:wrap.getAttribute('data-placeholder'),
    getSources({ query }) {
        return [
            {
                sourceId: 'products',
                getItems() {
                    return getAlgoliaResults({
                        searchClient,
                        queries: [
                            {
                                indexName: 'products',
                                query,
                                params: {
                                    hitsPerPage: 5,
                                    attributesToSnippet: ['title:10'],
                                    snippetEllipsisText: '…',
                                },
                            },
                        ],
                    });
                },
                templates: {
                    header({ items, html }) {
                        if (items.length === 0) {
                            return null;
                        }

                        return html`<span class="aa-SourceHeaderTitle">Products</span>
                            <div class="aa-SourceHeaderLine" />`;
                    },
                    item({ item, components, html }) {
                        return html`<div class="aa-ItemWrapper">
                      <a class="aa-ItemContent" href="${item.url}">
                        <div class="aa-ItemIcon aa-ItemIcon--picture aa-ItemIcon--alignTop">
                          <img
                            src="${item.image}"
                            alt="${item.title}"
                            width="80"
                            height="80"
                          />
                        </div>
                        <div class="aa-ItemContentBody">
                          <div class="aa-ItemContentTitle">
                            ${components.Highlight({
                                    hit: item,
                                    attribute: 'title',
                                })}
                          </div>
                          <div class="aa-ItemContentDescription">
                              <span>By <strong>${item?.brand?.name}</strong></span>${' '}
                              <span class="">in <strong>${item?.categories?.[0]['name']}</strong></span>
                          </div>
                        </div>
                      </a>
                    </div>`;
                            },
                        },
            },
        ];
    },
    classNames:{
        input:wrap.getAttribute('data-input-class'),
        inputWrapperPrefix:wrap.getAttribute('data-input-prefix')
    },
    plugins:[
        recentSearchesPlugin,
        categorySearch(searchClient)
    ],
    renderNoResults({ render, html, state }, root) {
        render(
            html`
        <div class="aa-PanelLayout aa-Panel--scrollable">
          No results for "${state.query}".
        </div>
      `,
            root
        )
    },
});
