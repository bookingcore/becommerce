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
                                    <div class="aa-ItemIcon aa-ItemIcon--noBorder aa-ItemIcon--alignTop">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
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
