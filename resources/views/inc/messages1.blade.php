<div style="padding-top: 10px">

        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger" style="display:inline-block">
                        <script>
                            $( document ).ready(function() {
                                $('#addNewPatalpaModal').modal('show');
                            });
                        </script>
                    {{ $error }}
                </div>
            @endforeach
        @endif
    
        @if(session('success'))
            <div class="alert alert-success" style="display:inline-block">
                {{ session('success') }}
            </div>
        @endif
    
        @if(session('error'))
            <div class="alert alert-danger" style="display:inline-block">
                {{ session('error') }}
            </div>
        @endif
    
        @if(session('warning'))
            <div class="alert alert-warning text-center" style="display:inline-block">
                {{ session('warning') }}
            </div>
        @endif
    </div>
    <script>
    $(".alert-success").delay(4000).slideUp(400, function() {
        $(this).alert('close');
    });
    </script>
    