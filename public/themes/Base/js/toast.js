window.BCToast = {
    info:function (content,timeout){
        if(typeof timeout == 'undefined') timeout = 0;
        var temp = `<div class="d-flex">
            <div class="toast-body">
            ${content}
           </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>`;
        var el = document.createElement('div');
        el.className = 'toast align-items-center';
        el.innerHTML = temp;
        document.getElementById('bc-toast-container').appendChild(el);
        var option = {
            autohide:false
        };
        if(timeout){
            option.autohide = true;
            option.delay = timeout;
        }
        var t = new bootstrap.Toast(el, option);
        t.show();
    },
}
