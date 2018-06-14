
<div class="container">
    <div class="row">

        {{--<button style="margin-top: 150px" > tinh diem </button>--}}
        {{--<form action="testex" method="post" enctype="multipart/form-data">--}}
        {{--<input type="file" name="file" />--}}
        {{--<input type="hidden" value="{{csrf_token()}}" name="_token">--}}
        {{--<input type="submit" value="Upload">--}}

        {{--</form>--}}
        <a href="{{ URL::to('caculate') }}"> tinh diem </a>


        <button style="margin-top: 150px" > doc excels </button>

    </div>
</div>
<style>
    .row {
        margin-top:  200px;
    }
</style>