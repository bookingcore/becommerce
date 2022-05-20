import {getAlgoliaResults} from "@algolia/autocomplete-js";

export default  function (searchClient){
    return {
        getSources({query}) {
            return [
                {
                    sourceId: 'product_category',
                    getItems() {
                        return getAlgoliaResults({
                            searchClient,
                            queries: [
                                {
                                    indexName: 'product_category',
                                    query,
                                    params: {
                                        hitsPerPage: 5,
                                        attributesToSnippet: ['name:10'],
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

                            return html`<span class="aa-SourceHeaderTitle">Categories</span>
                            <div class="aa-SourceHeaderLine" />`;
                        },
                        item({ item,components, html }) {
                            return html`<div class="aa-ItemWrapper">
                                <a class="aa-ItemContent" href="${item.url}">
                                    <div class="aa-ItemIcon aa-ItemIcon--alignTop">
                                        <img
                                            src="${item.image}"
                                            alt="${item.name}"
                                            width="40"
                                            height="40"
                                        />
                                    </div>
                                    <div class="aa-ItemContentBody">
                                        <div class="aa-ItemContentTitle">
                                            ${components.Highlight({
                                                hit: item,
                                                attribute: 'name',
                                            })}
                                        </div>
                                    </div>
                                </a>
                            </div>`;
                        },
                    },
                },
            ];
        }
    }
}
