@extends('layout.app')

@section('content')
<ol class="breadcrumb">     
    <li class="breadcrumb-item"><a href="https://destytojas.vdu.lt">Pagrindinis</a></li>
    <li class="breadcrumb-item"><a href="/">Pastatų ir patalpų registras</a></li>
    <li class="breadcrumb-item active">Vartotojai</li>
</ol>
@include('inc.messages')

<div class="card">
    <div class="card-heading bg-dark">
        <!-- HEADING -->
        <h5 class="text-center" style="position:relative">  

            <!-- Title -->
            <span style="color:white">Vartotojų priskirimas</span>
        </h5>
         <!-- END HEADING -->
    </div>
</div>
<div class="card">   
    <!-- Card Block -->
    <div class="card-block">
        <div class="table-responsive">
            <table class="table table-bordered table-hover auto" style="margin-top: 0px !important;">
                @if(count($users) >= 1)
                <thead class="thead-dark">
                    <tr>
                        <th><input type="checkbox" class="selectall"></th>
                        <th>Vartotojas</th>
                        <th>Priskirti pastatai</th>
                        <th>Veiksmas</th>
                    </tr>
                </thead> 
                <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td style="width: 12px;"><input type="checkbox" name="ids[]" class="selectbox" value="{{ $user->id }}"></td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <!-- Form Delete -->
                                    <form method="POST">
                                            @csrf
                                            @method('DELETE')    
                
                                        @foreach($user->pastatai as $pastatas) 
                                            {{ $pastatas->pavadinimas }} <button class="btn" id="trinti" formaction="{{ action('AssignController@detach', [$pastatas->id, $user->id]) }}" type="submit"><i class="fa fa-times-circle"></i></button><br/> 
                                        @endforeach
                                    </form>     
                                </td>
                                <td>
                                     <!-- Form OPEN -->
                                    {!! Form::open(['action' => ['AssignController@assign', $user->id], 'method' => 'POST']) !!}
                                        <div class="container" style="height:40px !important;">
                                            <div class="row">
                                                <div class="text-left">
                                                {{Form::select('pastatai_id', $pastatai, null,
                                                    [
                                                        'class' => 'form-control',
                                                        'placeholder' => '-Pastato kodas-',
                                                        'style' => 'width: 278px;',
                                                        'class' => 'pastatass',
                                                    ])
                                                }}<br/>
                                                </div>
                                                <div class="text-left" style="padding-left: 15px;">
                                                    {{ Form::submit('Pridėti', ['class' => 'btn btn-secondary']) }}
                                                </div>   
                                            </div>                                             
                                        </div>       
                                    <!-- Form CLOSE -->
                                    {!! Form::close() !!}
                                </td>
                                </tr>
                        @endforeach    
                </tbody>
                @else
                    <p class="alert alert-danger" style="border-radius:0px; margin-bottom:0px">Duomenų Nėra!</p>
                @endif
            </table>
            <div> <!--class="d-flex justify-content-center"-->
                <br/>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('.selectall').click( function () {
        $('.selectbox').prop('checked', $(this).prop('checked'));
        $('.selectall2').prop('checked', $(this).prop('checked'));
    })
    $('.selectall2').click( function () {
        $('.selectbox').prop('checked', $(this).prop('checked'));
        $('.selectall').prop('checked', $(this).prop('checked'));
    })
    $('.selectbox').change( function () {
        var total = $('.selectbox').length;
        var number = $('.selectbox:checked').length;
        if(total == number) {
            $('.selectall').prop('checked', true);
            $('.selectall2').prop('checked', true);
        } else {
            $('.selectall').prop('checked', false);
            $('.selectall2').prop('checked', false);
        }
    })
</script>

<script type="text/javascript">
    $(".pastatass").select2();
    allowClear: true;
</script>
    
@endsection
