@extends('back_layouts.back-master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h4>
                <span class="float-start"> Federacije </span>
                @if (auth()->user()->details->role == 'admin')
                <span class="float-end">
                    <a href="#" type="button" onclick="newFed()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-square" viewBox="0 0 16 16">
                            <path
                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg></a>
                </span>
                @endif
            </h4>
            <!-- ispis tablice -->
            <div class="table-responsive-sm mt-4" >
                <table class="table table-hover bg-light shadow">
                    <thead class="thead t-head">
                        <tr>
                            <th>ID</th>
                            <th>Logo</th>
                            <th>Naziv</th>
                            <th>Uredi</th>
                            @if (auth()->user()->details->role == 'admin')
                            <th>Obriši</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($federacije as $federacija)
                        <tr>
                            <td>{{$federacija->id}}</td>
                            <td><img src="{{ asset($federacija->logo)}}" height="30"></td>
                            <td> {{$federacija->name}}</td>
                            @if (auth()->user()->details->role == 'admin')
                            <td> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                </svg>
            </div>
            </td>

            <td><a href="del_fed/{{ $federacija->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path
                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd"
                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                    </svg></a></td>
            @endif
            </tr>

            @endforeach
            </tbody>
            </table>
        </div>
        <!-- Div za unos nove grupe-->
        <div id="noviUnos" style="display:none;">
            <!-- form start -->
            <form enctype="multipart/form-data" action="{{ route('federations.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group align-center">
                            <label for="logo">Logo federacije</label>
                            <br>
                            <img class="align-center img-responsive img-thumbnail" id="output" name="logo"
                                src="https://via.placeholder.com/250" width="250" alt="logo">
                            <br>
                            <input type="file" class="form-control-file pt-2" name="logo" accept="image/*"
                                onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name"><b>Naziv federacije:</b></label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="wm_categories"><b>Muške težinske kategorije:</b></label>
                            <textarea class="form-control" rows="2" name="wm_categories" style="width: 100%"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="wf_categories"><b>Ženske težinske kategorije:</b></label>
                            <textarea class="form-control" rows="2" name="wf_categories" style="width: 100%"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="age_categories"><b>Dobne kategorije:</b></label>
                            <textarea class="form-control" rows="2" name="age_categories"
                                style="width: 100%"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="points_system"><b>Bodovni sustav:</b></label>
                            <input type="text" class="form-control" name="points_system">
                        </div>
                        <div class="form-group">
                            <label for="divisions"><b>Divizije:</b></label>
                            <input type="text" class="form-control" name="divisions">
                        </div>
                        <div class="form-group">
                            <label for="disciplines"><b>Discipline:</b></label>
                            <input type="text" class="form-control" name="disciplines">
                        </div>
                    </div>
                </div>
                <div class="text-end pt-3 pb-2">
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
@section('js_after')
<script>
function newFed() {
    if (document.getElementById('noviUnos').style.display == "none")
        document.getElementById('noviUnos').style.display = "block";
    else
        document.getElementById('noviUnos').style.display = "none";
}
</script>
@endsection