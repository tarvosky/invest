@extends('layouts.app_home')
@section('content')
<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="widget p-md clearfix">
					<div>
						<h3 class="widget-title">Background Instruction</h3>
            <ul>
              <li >Select any of the picture below and it will automatically save</li>
              <li >If you want to upload your own image scroll to the bottom of the page</li>
          </ul>
					</div>
				</div><!-- .widget -->
			</div>

		
		</div><!-- .row -->




    <div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="widget p-md clearfix">
					<div >
            <div class="text-center">
              <img  width="120px" height="120px" style="margin-bottom:5px"id="myImg" src="{{ asset('license/background/sample.png')}}" class="pb-2" alt="...">
              <div id="loading" style="display:none;margin-top:5px" class="m-2"> <img  width="50px" height="50px" src="{{ asset('loading.gif')}}" /></div>
              <div id="saved" style="display:none;margin-top:5px" class="alert alert-success mt-3"> Image saved!!!</div>
            </div>
					</div>
				</div><!-- .widget -->
			</div>

			<div class="col-md-6 col-sm-6">
				<div class="widget p-md clearfix">
					<div class="">
            <h5 class="widget-title">When you are done you can navigate by clicking on the "finish button"</h5>
            <br><br>
            <div class="text-center mt-5 mt-5">
              <a class="btn btn-danger btn-lg" href="{{ asset('voidcheck')}}"> Finish >> </a>
          </div>
					</div>
				
				</div><!-- .widget -->
			</div>
		</div><!-- .row -->




		<div class="row">
			<div class="col-md-12">
				<div class="widget widget-pie-chart">
					<header class="widget-header">
						<h4 class="widget-title">Select voidcheck Background</h4>
          </header>
          <div class="widget-body">
          @foreach ($images as $item)
          <?php 
          $id = $item->id;
          $image = $item->image;
          ?>
          <div class="avatar avatar-xl">
            <img width="120px" height="120px" onClick='reply_click("<?php echo $id ?>","<?php echo $image ?>")' src="{{ asset('license/background/thumb/'.$item->image)}}" class="rounded pb-2" alt="..."></div>
              @endforeach
              <div class="mt-1"> {{ $images->links() }}</div>
            </div>
          </div>
          </div><!-- .widget -->
        </div>




</div>
</div>
</div><!-- .widget -->
</div>
</div><!-- .row -->
@endsection

@push('scripts')

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>

<script type="text/javascript">
   

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function() {
         $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "{{ asset('voidcheck/get-selected-background/'. $voidcheck->id )}}",       
          success: function (data) {
            var theUrl = "{{ asset('license/background') }}";
           // $("#myimage").html(data.success);
           // console.log(theUrl+data.success);
            document.getElementById("myImg").src = theUrl+"/"+data.success;
          },
            error: function (data) {
            var errors = $.parseJSON(data.responseText);
            console.log(errors);
            }
        });
      });


  function reply_click(id,image)
  {
     // alert(id+'--'+image);
     
     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
     document.getElementById("loading").style.display = "block";
     $.ajax({
            url:"{{ asset('voidcheck/update-selected-background/'. $voidcheck->id )}}",
            type: 'post',
             data: {_token: CSRF_TOKEN,image:image},
            dataType:'json',
           success: function (data) {
           console.log(data);
           console.log(image);
           var theUrl = "{{ asset('license/background/thumb') }}";
           document.getElementById("myImg").src = theUrl+"/"+image;
           document.getElementById("loading").style.display = "none";
           document.getElementById("saved").style.display = "block";
            },
            error: function (data) {
            var errors = $.parseJSON(data.responseText);
            console.log(errors);
            }
        })


  }


</script>
@endpush
