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
                    <form id="createForm" action="{{ $url }}" method="{{ $method }}" enctype="multipart/form-data">
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
            <div class="card bg-dark">
                <div class="card-header mb-2">
                    <h6 class="card-title"><strong>Imagen destacada</strong></h6> 
                </div>
                <div class="card-body mb-4">
                    <!-- Modal -->
                    <div class="modal fade" id="elegirImagen" tabindex="-1" role="dialog" aria-labelledby="elegirImagenLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-muted">
                                    <h5 class="modal-title" id="elegirImagenLabel">Seleccione o suba alguna imagen</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-dark">
                                    <div class="img-group fixed-height">
                                        @foreach(App\Media::all() as $image)
                                            <img src="{{ asset('storage/media/'.$image->image) }}" alt="{{ $image->name }}" class="img-item">
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <div class="upload-btn-wrapper">
                                            <button class="btn btn-info">
                                                <i class="fas fa-file-image"></i>
                                                <strong>Subir una imagen</strong>
                                            </button>
                                            <input type="file" class="btn btn-secondary" id="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                    <div class="mt-2">
                        <button class="btn btn-secondary" role="button" data-toggle="modal" data-target="#elegirImagen">
                            <i class="fas fa-image"></i>
                            Establecer imagen
                        </button>
                    </div>
                </div>
                @if($entry->image != NULL) 
                <div class="card-avatar">
                    <img src="{{ asset('storage/media/'.$entry->image.$entry->imageType) }}" alt="{{$entry->title}}" class="img img-resize">
                </div>
                @endif
            </div>
        </div>
    </div>