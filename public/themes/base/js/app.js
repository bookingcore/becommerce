// dropdown
$('.bc-dropdown .bc-dropdown-btn').on('click',function(){
    $(this).parent().closest('.bc-dropdown').toggleClass('show');
})
$('.bc-dropdown .bc-close').on('click',function(){
    $(this).parent().closest('.bc-dropdown').removeClass('show');
})
