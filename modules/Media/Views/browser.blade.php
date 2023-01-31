<div id="cdn-browser-modal" class="modal fade @if(!empty($tailwind)) hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full @endif">
    <div class="modal-dialog modal-xl @if(!empty($tailwind)) relative p-4 w-full max-w-7xl h-full md:h-auto @endif">
        <div class="modal-content @if(!empty($tailwind)) relative bg-white rounded-lg shadow dark:bg-gray-700 @endif">
            <div id="cdn-browser" class="cdn-browser d-flex flex-column flex-col flex" v-cloak :class="{is_loading:isLoading}">
                <div class="files-nav flex-shrink-0">
                    <div class="d-flex justify-content-between flex justify-between">
                        <div class="col-left d-flex align-items-center flex items-center">
                            <div class="filter-item">
                                <input type="text" placeholder="{{__("Search file name....")}}" class="form-control" v-model="filter.s" @keyup.enter="filter.page = 1;reloadLists()">
                            </div>
                            <div class="filter-item">
                                <button class="btn btn-default focus:outline-none border border-gray-300 shadow-sm text-gray-700 hover:bg-gray-50 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="filter.page = 1;reloadLists()">
                                    <i class="fa fa-search"></i> {{__("Search")}}</button>
                            </div>
                            <div class="filter-item">
                                <small><i>{{__("Total")}}: @{{total}} {{__("files")}}</i></small>
                            </div>
                        </div>
                        <div class="col-right d-flex flex">
                            <i class="fa-spin fa fa-spinner icon-loading active" v-show="isLoading"></i>
                            <button class="btn btn-success btn-pick-files focus:outline-none text-white bg-green-600 hover:bg-green-800 focus:ring-2 focus:ring-green-300">
                                <span><i class="fa fa-upload"></i> {{__("Upload")}}</span>
                                <input :accept="accept_type" multiple type="file" name="files[]" ref="files">
                            </button>
                            @if(empty($tailwind))
                                <button type="button" class="btn btn-default ml-2" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-times"></i>
                                </button>
                            @else
                            <button type="button" class="btn btn-default ml-2 border text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-dismiss-modal="cdn-browser-modal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="upload-new" v-show="showUploader" display="none">
                    <input type="file" name="filepond[]" class="my-pond">
                </div>
                <div class="files-list">
                    <div class="files-wraps " :class="'view-'+viewType">
                        <file-item v-for="(file,index) in files" :key="index" :view-type="viewType" :selected="selected" :file="file" v-on:select-file="selectFile"></file-item>
                    </div>
                    <p class="no-files-text text-center" v-show="!total && apiFinished" style="display: none">{{__("No file found")}}</p>
                    <div class="text-center" v-if="totalPage > 1">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item" :class="{disabled:filter.page <= 1}">
                                    <a class="page-link" v-if="filter.page <=1">{{__("Previous")}}</a>
                                    <a class="page-link" href="#" v-if="filter.page > 1" v-on:click="changePage(filter.page-1,$event)">{{__("Previous")}}</a>
                                </li>
                                <li class="page-item" v-if="p >= (filter.page-3) && p <= (filter.page+3)" :class="{active: p == filter.page}" v-for="p in totalPage" @click="changePage(p,$event)">
                                    <a class="page-link" href="#">@{{p}}</a></li>
                                <li class="page-item" :class="{disabled:filter.page >= totalPage}">
                                    <a v-if="filter.page >= totalPage" class="page-link">{{__("Next")}}</a>
                                    <a href="#" class="page-link" v-if="filter.page < totalPage" v-on:click="changePage(filter.page+1,$event)">{{__("Next")}}</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="browser-actions d-flex justify-content-between flex-shrink-0 flex justify-between shrink-0" v-if="selected.length">
                    <div class="col-left" v-show="selected.length">
                        <div class="control-remove" v-if="selected && selected.length">
                            <button class="btn btn-danger" @click="removeFiles">{{__("Delete file")}}</button>
                        </div>
                        <div class="control-info" v-if="selected && selected.length">
                            <div class="count-selected">@{{selected.length}} {{__("file selected")}}</div>
                            <div class="clear-selected" @click="selected=[]"><i>{{__("unselect")}}</i></div>
                        </div>
                    </div>
                    <div class="col-right" v-show="selected.length">
                        <button class="btn btn-primary focus:outline-none text-white bg-amber-400 hover:bg-amber-600 focus:ring-2 focus:ring-amber-400" :class="{disabled:!selected.length}" @click="sendFiles">{{__("Use file")}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/x-template" id="file-item-template">
    <div class="file-item" :class="fileClass(file)">
        <div class="inner" :class="{active:selected.indexOf(file.id) !== -1 }" @click="selectFile(file)" :title="file.file_name">
            <div class="file-thumb" v-if="viewType=='grid'" v-html="getFileThumb(file)">
            </div>
            <div class="file-name">@{{file.file_name}}</div>
            <span class="file-checked-status" v-show="selected.indexOf(file.id) !== -1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M186.301 339.893L96 249.461l-32 30.507L186.301 402 448 140.506 416 110z"/></svg>
            </span>
        </div>
    </div>
</script>
