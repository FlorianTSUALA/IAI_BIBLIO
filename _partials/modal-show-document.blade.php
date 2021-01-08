<form action="{{route('document.store')}}" method="post" enctype="multipart/form-data">
    @csrf                    

    <div class="modal grow modal-backdrop-white fade" id="modal-add-document">
        <div class="modal-dialog modal-lg">
            <div class="v-cell">
                <div class="modal-content">

                  
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span
                                    aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Telecharger le document </h4>

                            <div class="box">
                                <input type="file" name="file-pdf" id="file-pdf" class="inputfile inputfile-doc" accept="application/pdf" />
                                <label for="file-pdf"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17"
                                        viewBox="0 0 20 17">
                                        <path
                                            d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                        </svg> <span>Download&hellip;</span></label>
                            </div>

                        </div>
                        <div class="modal-body">

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-md-8">
                                        <div style="text-align: center;">
                                            <iframe id="pdf-display"
                                                
                                              
                                                style="width:500px; height:500px;" frameborder="0"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a  class="btn btn-success paper-shadow relative" data-z="0.5"
                                data-hover-z="1" data-animated data-dismiss="modal">Publier</a>
                            <button type="submit" class="btn btn-primary paper-shadow relative" data-z="0.5" data-hover-z="1" >Archiver</button>

                        </div>
                </div>
            </div>
        </div>
    </div>
</form>


