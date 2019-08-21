<div style="padding-top: 10px">
    @if(!empty($wellcome))
        <div class="alert alert-success text-center" style="display:inline-block">
            {{ $wellcome }}
        </div>
    @endif
</div>
<script>
    $(".alert-success").delay(4000).slideUp(400, function() {
        $(this).alert('close');
    });
</script>


