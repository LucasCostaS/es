<div class="alert-container">

        @php
            
            $sessions = [
                [ "type" => "success", "class" => "alert-success" ],
                [ "type" => "error", "class" => "alert-danger" ],
                [ "type" => "warning", "class" => "alert-warning" ],
            ];
            
        @endphp
        
        @foreach ($sessions as $session)
        
            @if (Session::has($session['type']))
            <div class="alert alert-dismissible fade show {{ $session['class'] }} animated fadeInDown">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></button>
                <p>{!! Session::get($session['type']) !!}</p>
            </div>
            @endif
        
        @endforeach
        
        @if (count($errors) > 0)
        <div class="alert alert-dismissible fade show alert-danger animated fadeInDown">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></button>
            <p>{{ $errors->all()[0] }}</p>
        </div>
        @endif
        
    </div>