@extends("layouts.backend")
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Ayarlar
                <small>Başlıca Site Ayarları</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Responsive Hover Table</h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Anahtar</th>
                                        <th>Değer</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($settings as $setting)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$setting->key}}</td>
                                        <td><input class="form-control settingInput" type="text" value="{{$setting->value}}" name="{{$setting->key}}" ></td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection

@push("customJs")
    <script>

        $(".settingInput").on("change",function (){
            $input = $(this);
            $.ajax({
                type : "post",
                url : "{{route("backend.settings.update")}}",
                data: {
                    _token: "{{csrf_token()}}",
                    key   : $input.attr("name"),
                    value : $input.val()
                },
                success: function (response){
                    console.log("başarılı");
                    console.log(response);
                },
                error: function (){
                    console.log("Bir Hata oluştu");
                    console.log(response);
                }
            });
        });

    </script>
@endpush

@push("customCss")
@endpush