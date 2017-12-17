@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(session()->has($msg))
        <div class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">温馨提示</h4>
                    </div>
                    <div class="modal-body">
                        <p class="alert alert-{{ $msg }}">
                            {{ session()->get($msg) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('.modal').modal();
        </script>
    @endif
@endforeach