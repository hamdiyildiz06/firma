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
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default pull-right" id="newSetting">Yeni Ekle</button>
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
                                        <th>Sil</th>
                                    </tr>
                                </thead>

                                <tbody id="settingTableBody">

                                @foreach($settings as $setting)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$setting->key}}</td>
                                        <td><input class="form-control settingInput" type="text" value="{{$setting->value}}" name="{{$setting->key}}" ></td>
                                        <td><button data-key="{{$setting->key}}" class="btn btn-danger settingDelete">Sil</button> </td>
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

        $("#newSetting").click(function (){
            var data = "<tr>\n" +
                "<td>yeni</td>" +
                    "<td><input class=\"form-control\" type=\"text\" name=\"key\" id='newSettingKey' ></td>" +
                    "<td><input class=\"form-control\" type=\"text\"  name=\"value\" id='newSettingValue' ></td>" +
                "</tr>"
            $("#settingTableBody").prepend(data);

            $(document).on("change","#newSettingKey", function (){
                if( $(this).val().length > 3 && $("#newSettingValue").val().length > 3 ){
                    newSetting();
                }
            });

            $(document).on("change","#newSettingValue", function (){
               if ( $(this).val().length > 3 && $("#newSettingKey").val().length > 3 ){
                   newSetting();
               }
            });

            function newSetting(){
                var key   = $("#newSettingKey").val();
                var value = $("#newSettingValue").val();

                $.ajax({
                    type  : "post",
                    url   : "{{route("backend.settings.create")}}",
                    data  : {
                        _token: "{{csrf_token()}}",
                        key   : key,
                        value : value
                    },
                    success: function (response){
                        if (response.status == "success"){
                            location.reload();
                        }
                        console.log(response);
                    },
                    error: function (){
                        if (response.status == "error"){
                            console.log(response)
                        }
                    }
                })
            }

        })

        $(".settingDelete").click(function (){
            var button = $(this);
            $(this).closest("tr").remove();

            $.ajax({
               type : "POST",
               url  : "{{route("backend.settings.delete")}}",
               data : {
                   _token : "{{csrf_token()}}",
                   key    : button.data("key"),

               },
               success: function (response){
                   if (response.status == "success"){
                       button.closest("tr").remove();
                   }
                   console.log(response)
               },
                error:  function (response){
                   console.log(response);
                }
            });
        });

    </script>
@endpush

@push("customCss")
@endpush