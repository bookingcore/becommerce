import '../../css/components/toast.css'
const Default = {};

class BCToast{
    constructor(options = {}) {
        this._wrap = null
        this._options = { ...Default, ...options }
        this._init();
    }
    _init(){
        this._wrap = document.createElement('div');
        this._wrap.className = 'fixed top-0 right-0 p-4 toast-container z-900';
        this._wrap.style['z-index'] = '900';
        document.body.appendChild(this._wrap);
    }
    info(content,timeout){
        if(typeof timeout == 'undefined') timeout = 5000;
        var icon = `<svg viewBox="0 0 24 24" fill="var(--bc-toast-color-info)">
      <path d="M12 0a12 12 0 1012 12A12.013 12.013 0 0012 0zm.25 5a1.5 1.5 0 11-1.5 1.5 1.5 1.5 0 011.5-1.5zm2.25 13.5h-4a1 1 0 010-2h.75a.25.25 0 00.25-.25v-4.5a.25.25 0 00-.25-.25h-.75a1 1 0 010-2h1a2 2 0 012 2v4.75a.25.25 0 00.25.25h.75a1 1 0 110 2z" />
    </svg>`;
        this._show(icon,content,timeout,'info');
    }
    loading (content,timeout){
        if(typeof timeout == 'undefined') timeout = 0;
        var icon = `<div class="bc_spinner"></div>`;
        return this._show(icon,content,timeout,'loading');
    }
    success (content,timeout){
        if(typeof timeout == 'undefined') timeout = 5000;
        var icon = `<svg viewBox="0 0 24 24" fill="var(--bc-toast-color-success)">
      <path d="M12 0a12 12 0 1012 12A12.014 12.014 0 0012 0zm6.927 8.2l-6.845 9.289a1.011 1.011 0 01-1.43.188l-4.888-3.908a1 1 0 111.25-1.562l4.076 3.261 6.227-8.451a1 1 0 111.61 1.183z" />
    </svg>`;
        this._show(icon,content,timeout,'success');
    }
    warning (content,timeout){
        if(typeof timeout == 'undefined') timeout = 5000;
        var icon = `<svg viewBox="0 0 24 24" fill="var(--bc-toast-color-warning)">
      <path d="M23.32 17.191L15.438 2.184C14.728.833 13.416 0 11.996 0c-1.42 0-2.733.833-3.443 2.184L.533 17.448a4.744 4.744 0 000 4.368C1.243 23.167 2.555 24 3.975 24h16.05C22.22 24 24 22.044 24 19.632c0-.904-.251-1.746-.68-2.44zm-9.622 1.46c0 1.033-.724 1.823-1.698 1.823s-1.698-.79-1.698-1.822v-.043c0-1.028.724-1.822 1.698-1.822s1.698.79 1.698 1.822v.043zm.039-12.285l-.84 8.06c-.057.581-.408.943-.897.943-.49 0-.84-.367-.896-.942l-.84-8.065c-.057-.624.25-1.095.779-1.095h1.91c.528.005.84.476.784 1.1z" />
    </svg>`;
        this._show(icon,content,timeout,'warning');
    }
    error (content,timeout){
        if(typeof timeout == 'undefined') timeout = 5000;
        var icon = `<svg viewBox="0 0 24 24" fill="var(--bc-toast-color-error)">
      <path d="M11.983 0a12.206 12.206 0 00-8.51 3.653A11.8 11.8 0 000 12.207 11.779 11.779 0 0011.8 24h.214A12.111 12.111 0 0024 11.791 11.766 11.766 0 0011.983 0zM10.5 16.542a1.476 1.476 0 011.449-1.53h.027a1.527 1.527 0 011.523 1.47 1.475 1.475 0 01-1.449 1.53h-.027a1.529 1.529 0 01-1.523-1.47zM11 12.5v-6a1 1 0 012 0v6a1 1 0 11-2 0z" />
    </svg>`;
        this._show(icon,content,timeout,'error');
    }
    showAjaxError(e){
        var json = e.responseJSON;
        if(typeof json !='undefined'){
            if(typeof json.errors !='undefined'){
                var html = '';
                _.forEach(json.errors,function (val) {
                    html+=val+'<br>';
                });

                return this.error(html);
            }
            if(json.message){
                return this.error(json.message);
            }
        }
        if(e.responseText){
            return this.error(e.responseText);
        }
    }
    showAjaxSuccess(data,timeout){
        console.log(data);
        if(data.message){
            this.success(data.message,timeout);
        }
    }
    _show (icon,content,timeout,type){
        var progressBar = `<div class="toast-progressbar toast-progressbar--animated" style="animation-duration: 5000ms;opacity: 1;background: var(--bc-toast-color-${type})"></div>`;

        if(!timeout){
            progressBar = '';
        }
        var temp = `<div  class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="toast-body flex align-content-center">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-5 h-5">${icon}</div>
                <div class="ml-3 font-normal">${content}</div>
           </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-close="" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
          </div>${progressBar}`;

        var el = document.createElement('div');
        el.className = 'bc-toast toast items-center relative';
        el.innerHTML = temp;
        this._wrap.appendChild(el);
        var option = {
            autohide:false
        };
        if(timeout){
            option.autohide = true;
            option.delay = timeout;
        }
        return new ToastItem(el,option);
    }
}
const ItemDefault = {
    autohide:true,
    delay:5000
};
class ToastItem{
    constructor(el,options = {}) {
        this._el = el
        this._options = { ...ItemDefault, ...options }
        this._init();
    }
    _init(){
        var me = this;
        if(this._options.autohide){
            window.setTimeout(function(){
                me.hide();
            },this._options.delay)
        }
        // Event
        const btn = this._el.querySelector('[data-close]');
        if(btn){
            btn.addEventListener('click',function () {
                me.hide();
            })
        }
    }
    hide(){
        this._el.style.display = 'none';
    }
}

window.BCToast = new BCToast;

export default BCToast
