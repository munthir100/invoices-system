@if($errors->any() || session()->has('success'))
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/toastr.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css-rtl/plugins/extensions/ext-component-toastr.css">
<script src="../../../app-assets/vendors/js/jquery/jquery.min.js"></script>
<script src="../../../app-assets/vendors/js/extensions/toastr.min.js"></script>
<script src="../../../app-assets/js/scripts/extensions/ext-component-toastr.js"></script>
@foreach($errors->all() as $error)
<script>
    var isRtl = $('html').attr('data-textdirection') === 'rtl';
    toastr['error']('{{$error}}', 'Error!', {
        closeButton: true,
        tapToDismiss: false,
        progressBar: true,
        showMethod: 'slideDown',
        hideMethod: 'slideUp',
        timeOut: 5000,
        rtl: isRtl
    });
</script>
@endforeach
@endif

@if(session()->has('success'))
<script>
    var isRtl = $('html').attr('data-textdirection') === 'rtl';
    toastr['success']('{{session()->get("success")}}', 'Success!', {
        closeButton: true,
        tapToDismiss: false,
        progressBar: true,
        showMethod: 'slideDown',
        hideMethod: 'slideUp',
        timeOut: 5000,

        rtl: isRtl
    });
</script>
@endif