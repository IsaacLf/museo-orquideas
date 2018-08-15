<div class="row my-inline">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-success">
                    @if($method == 'POST')
                        <h4 class="card-title">Crea una nueva entrada</h4>
                        <p class="card-category">Completa los campos</p>
                    @else
                        <h4 class="card-title">Edita la entrada</h4>
                        <p class="card-category">Modifique los campos</p>
                    @endif
                </div>
                <div class="card-body">
                    <form id="createForm" action="{{ url($url) }}" method="{{ $method }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="entryTitle" class="bmd-label-floating">Titulo</label>
                            <input class="form-control" type="text" name="title" id="entryTitle" value="{{$entry->title}}" required>
                        </div>
                        <div class="form-group">
                            <label for="entrySyno" class="bmd-label-floating">Sinónimo</label>
                            <input class="form-control" type="text" name="synonym" id="entrySyno" value="{{$entry->synonym}}" required>
                        </div>
                        <div class="form-group">
                            <label for="entryDist" class="bmd-label-floating">Distribución</label>
                            <input class="form-control" type="text" name="distribution" id="entryDist" value="{{$entry->distribution}}" required>
                        </div>
                        <div class="form-group">
                            <label for="entryDesc" class="bmd-label-static"><strong> Descripción </strong></label>
                            <textarea class="form-control" type="text" name="description" id="entryDesc" rows="8" required>{{ $entry->description }}</textarea>
                        </div>
                    </form>                
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark mb-5">
                <div class="card-header">
                    <h6 class="card-title"><strong>Guardar</strong></h6>
                </div>
                <div class="card-body text-center mb-4">
                    <input form="createForm" type="submit" class="btn btn-success" value="Guardar">
                    <a href="{{ url('/edit') }}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
            <image-picker
            :images="{{ App\Media::all() }}"
            :entry="{{ $entry }}"
            :asset="`{{ asset('storage/media') }}`"
            >
            </image-picker>
        </div>
    </div>