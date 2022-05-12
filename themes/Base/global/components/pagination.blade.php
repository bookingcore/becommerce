<script type="text/x-template" id="bc_pagination">
    <ul
        v-bind="$attrs"
        class="pagination"
        :class="{
                'pagination-sm': size == 'small',
                'pagination-lg': size == 'large',
                'justify-content-center': align == 'center',
                'justify-content-end': align == 'right'
            }"
        v-if="total > perPage">

        <li class="page-item pagination-prev-nav" :class="{'disabled': !prevPageUrl}" v-if="prevPageUrl || showDisabled">
            <a class="page-link" href="#" aria-label="Previous" :tabindex="!prevPageUrl && -1" @click.prevent="previousPage">
                <slot name="prev-nav">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">{{__('Previous')}}</span>
                </slot>
            </a>
        </li>

        <li class="page-item pagination-page-nav" v-for="(page, key) in pageRange" :key="key" :class="{ 'active': page == currentPage }">
            <a class="page-link" href="#" @click.prevent="selectPage(page)">
                @{{ page }}
                <span class="sr-only" v-if="page == currentPage">(current)</span>
            </a>
        </li>

        <li class="page-item pagination-next-nav" :class="{'disabled': !nextPageUrl}" v-if="nextPageUrl || showDisabled">
            <a class="page-link" href="#" aria-label="Next" :tabindex="!nextPageUrl && -1" @click.prevent="nextpage">
                <slot name="next-nav">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">{{__('Next')}}</span>
                </slot>
            </a>
        </li>

    </ul>
</script>
<script>
    Vue.component('bc-pagination', {
        emits: ['change'],
        inheritAttrs: false,
        template: '#bc_pagination',
        props: {
            limit: {
                type: Number,
                default: 0
            },
            showDisabled: {
                type: Boolean,
                default: false
            },
            size: {
                type: String,
                default: 'default',
                validator: value => {
                    return ['small', 'default', 'large'].indexOf(value) !== -1;
                }
            },
            align: {
                type: String,
                default: 'left',
                validator: value => {
                    return ['left', 'center', 'right'].indexOf(value) !== -1;
                }
            },
            data: {
                type: Object,
                default: () => {}
            },
        },
        computed: {
            isApiResource () {
                return !!this.data.meta;
            },
            currentPage () {
                return this.isApiResource ? this.data.meta.current_page : this.data.current_page;
            },
            firstPageUrl () {
                return this.isApiResource ? this.data.links.first : null;
            },
            from () {
                return this.isApiResource ? this.data.meta.from : this.data.from;
            },
            lastPage () {
                return this.isApiResource ? this.data.meta.last_page : this.data.last_page;
            },
            lastPageUrl () {
                return this.isApiResource ? this.data.links.last : null;
            },
            nextPageUrl () {
                return this.isApiResource ? this.data.links.next : this.data.next_page_url;
            },
            perPage () {
                return this.isApiResource ? this.data.meta.per_page : this.data.per_page;
            },
            prevPageUrl () {
                return this.isApiResource ? this.data.links.prev : this.data.prev_page_url;
            },
            to () {
                return this.isApiResource ? this.data.meta.to : this.data.to;
            },
            total () {
                return this.isApiResource ? this.data.meta.total : this.data.total;
            },
            pageRange () {
                if (this.limit === -1) {
                    return 0;
                }
                if (this.limit === 0) {
                    return this.lastPage;
                }
                var current = this.currentPage;
                var last = this.lastPage;
                var delta = this.limit;
                var left = current - delta;
                var right = current + delta + 1;
                var range = [];
                var pages = [];
                var l;
                for (var i = 1; i <= last; i++) {
                    if (i === 1 || i === last || (i >= left && i < right)) {
                        range.push(i);
                    }
                }
                range.forEach(function (i) {
                    if (l) {
                        if (i - l === 2) {
                            pages.push(l + 1);
                        } else if (i - l !== 1) {
                            pages.push('...');
                        }
                    }
                    pages.push(i);
                    l = i;
                });
                return pages;
            }
        },
        methods: {
            previousPage () {
                this.selectPage((this.currentPage - 1));
            },
            nextPage () {
                this.selectPage((this.currentPage + 1));
            },
            selectPage (page) {
                if (page === '...') {
                    return;
                }
                this.$emit('change', page);
            },
        },
    });
</script>
