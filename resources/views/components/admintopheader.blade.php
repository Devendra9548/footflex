<topheader>
    <div class="topheader d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-6 d-flex align-items-center justify-content-start">
                    <h2 class="top-head">
                    <?php
                    $cookie = Cookie::get('name');
                    echo $cookie;
                    ?>
                    </h2>
                </div>
                <div class="col-6 d-flex align-items-center justify-content-end">
                    <h2 class="top-head-"><a href="/" target="_blank" class="text-decoration-none btn btn-primary text-white mr-3">View
                            Website <i class="fa-solid fa-up-right-from-square"></i></a><a href="/admin/logout" class="btn btn-dark text-white ml-3" style="text-decoration:none;margin-left: 15px;"><i class="fa fa-sign-out" aria-hidden="true"></i>
                        </a></h2>
                </div>
            </div>
        </div>
    </div>
</topheader>