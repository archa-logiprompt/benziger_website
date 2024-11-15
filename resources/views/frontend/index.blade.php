<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>


<<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">


    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <div class="table-responsive">
                        <div class="container">

                            <div class="d-flex flex-wrap">
                                <div class="container">
                                    <div id="inputs" class="inputs">
                                        <form action="{{ route('user.otp') }}" method="POST">
                                            @csrf
                                            <input type="text" name="otp" required />
                                            <button type="submit">submit</button>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    </div>
    </body>
    <script></script>

</html>
