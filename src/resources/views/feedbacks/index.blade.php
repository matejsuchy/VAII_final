@extends('layouts.app')

@section('content')
<div class="container main-content">
    <h1>Spätná väzba od návštevníkov</h1>
    
   <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addFeedback">
    Pridať spätnú väzbu
    </button>
  
    <!-- ADD Modal -->
    <div class="modal fade" id="addFeedback" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Zanechajte nám spätnú väzbu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <form id="feedbackForm" class="contact-form container gx-4">
                    @csrf
                    <div class="row g-3">        
                        <div class="form-input">
                            <label for="request">Tu napíš svoju požiadavku, nápad alebo odkaz</label>
                            <textarea required class="form-control @error('request') is-invalid @enderror" name="request" id="request" placeholder="Tvoja správa"></textarea>
                            @error('request')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ukončiť</button>
                        <button type="submit" class="btn btn-success">Odoslať</button>
                    </div>
                </form>

            </div>
        </div>
        </div>
    </div>

    
    <!-- EDIT Modal -->
    <div class="modal fade" id="editFeedback" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel2">Upraviť spätnú väzbu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <form id="feedbackEditForm" class="contact-form container gx-4">
                    @csrf
                    <input type="hidden" id="id" name="id"/>
                    <div class="row g-3">
                        <div class="form-input">
                            <label for="request2">Tu napíš svoju požiadavku, nápad alebo odkaz</label>
                            <textarea required class="form-control @error('request2') is-invalid @enderror" name="request2" id="request2" placeholder="Tvoja správa"></textarea>
                            @error('request2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ukončiť</button>
                        <button type="submit" class="btn btn-success">Odoslať</button>
                    </div>
                </form>

            </div>
        </div>
        </div>
    </div>

    {!! $grid->show() !!}

    <script>
        let tabulka = document.querySelector('table');
        tabulka.id = "feedbackTable";
    </script>
    {{-- ADD jQuery --}}
<script>
    $("#feedbackForm").submit(function(e) {
        e.preventDefault();

        let current = new Date();
        let cDate = current.getFullYear() + '-' + (current.getMonth() + 1) + '-' + current.getDate();
        let cTime = current.getHours() + ":" + current.getMinutes() + ":" + current.getSeconds();
        let dateTime = cDate + ' ' + cTime;

        let name = "{{\Auth::user()->name}}";
        let comment = $("#request").val();
        let email = "{{ \Auth::user()->email }}";
        let _token = $("input[name=_token]").val();
        let user_id = "{{\Auth::user()->id}}";

        $.ajax({
            url: "{{ route('feedback.store') }}",
            type: "POST",
            data: {
                name:name,
                comment:comment,
                email:email,
                user_id:user_id,
                _token:_token
            },
            success:function(response) {
                if(response) {
                    console.log(response);
                    $("#feedbackTable tbody").prepend('<tr><td>'+ response.name +'</td><td>'+ response.email +'</td><td>'+ response.comment +'</td><td>'+ dateTime +'</td><td><a href="javascript:void(0)" onclick="editFeedback('+response.id+')" title="Edit" class="btn btn-primary btn-sm">Upraviť</a><a href="javascript:void(0)" onclick="deleteFeedback('+response.id+')" class="btn btn-danger btn-sm sid'+response.id+'">Zmaž</a></td></tr>');
                    $("#feedbackForm")[0].reset();
                    $("#addFeedback").modal('hide');
                }
            }
        });
    });
</script>

<script>
    function editFeedback(id) {
        $.get('/feedback/'+id, function (feedback) {
            $("#id").val(feedback.id);
            $("#request2").val(feedback.comment);
            $("#editFeedback").modal('toggle');
        });
    }

    $("#feedbackEditForm").submit( function (e) {
        e.preventDefault();
        let id = $("#id").val();
        let name = "{{ Auth::user()->name }}";
        let comment = $("#request2").val();
        let email = "{{ Auth::user()->email }}";
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('feedback.update') }}",
            type: "PUT",
            data: {
                id:id,
                name:name,
                comment:comment,
                email:email,
                _token:_token
            },
            success:function(response) {
                console.log(response);
                let row = document.querySelector('.sid'+response.id).parentElement.parentElement;
                row.querySelector('td:nth-child(1)').innerText = response.name;
                row.querySelector('td:nth-child(2)').innerText = response.email;
                row.querySelector('td:nth-child(3)').innerText = response.comment;
                row.querySelector('td:nth-child(4)').innerText = response.created_at;
                $("#editFeedback").modal('toggle'); 
                $("#feedbackEditForm")[0].reset();
            }
        });
    });
</script>

<script>
    function deleteFeedback(id) {
        if(confirm("Naozaj chcete odstranit zaznam?"))
        {
            $.ajax ({
                url: '/feedback/'+id,
                type: 'DELETE',
                data:{
                    _token: $("input[name=_token]").val()
                },
                success:function(response)
                {
                    document.querySelector('.sid'+id).parentElement.parentElement.remove();
                }
            })
        }
    }
</script>
</div>

@endsection
