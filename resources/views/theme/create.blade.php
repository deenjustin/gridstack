@extends('layout.metronic')
@section('page','Create Layout')
@section('content')
@include('layout.gridstack')
<script src="{{ url('') }}/assets/scripts/jquery.min.js"></script>
<div class="row ">

    <form method="POST" action="{{ url('layout') }}" class="row col-12">
        @csrf
    <div class="col-md-2 pl-4 d-none d-md-block side">
        <div
          id="trash"
          style="padding: 5px; margin-bottom: 15px"
          class="text-center bg-warning text-danger"
        >
          <div>
            <ion-icon name="trash" style="font-size: 300%"></ion-icon>
          </div>
          <div>
            <i class="fa fa-trash fa-3x" aria-hidden="true"></i>
          </div>
        </div>

        <div class="newWidget grid-stack-item mb-2 b1" id="gridcontent">
          <div class="grid-stack-item-content">

          </div>
        </div>
        <div class="row">
          <div class="col-12">
            Do You Want Save? <input type="checkbox" id="isAgree" />
          </div>
            <div class="col-12" style="display: none" id="savebtn">
                <input
                type="text"
                class="form-control form-control-sm"
                id="fname"
                placeholder="Enter File Name"
                name="fname"
                />
                <br />
                <button class="btn btn-info btn-block btn-sm" type="submit" id="save">
                Save
                </button>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-10" id="cnt">
        <div class="grid-stack" ></div>
      </div>
      <div class="col-12 p-2">
        <textarea
          id="saved-data"
          cols="100"
          rows="20"
          name="fdata"
          readonly="readonly"
          style="display: none;"
        ></textarea>
      </div>
    </form>
</div>
<div class="row border border-right-0  border-bottom-0 border-left-0 pt-4 pb-4">
    <div class="col-12">
        <button onclick="history.back()"  class="btn btn-secondary float-right mr-2 closeBtn"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Cancel</button>
    </div>
</div>

<script type="text/javascript">
    let grid = GridStack.init({
  cellHeight: 30,
  acceptWidgets: true,
  dragIn: '.newWidget', // class that can be dragged from outside
  dragInOptions: { appendTo: 'body', helper: 'clone' }, // clone or can be your function
  removable: '#trash', // drag-out delete class
});

let items = [
  {
    x: 0,
    y: 0,
    w: 4,
    h: 2,
    // content: '1',
    // noMove: true, noResize: true
  },
];
//grid.load(items);
function loadGrid() {
  grid.load(items, true); // update things
}
//let serializedFull;
function saveGrid() {
  //alert('Halo');
  //delete serializedFull;
  items = grid.save();
  let savedata = JSON.stringify(items, null, '  ');
  let text = 'Do You Want Save?';
  if (confirm(text) == true) {
    document.querySelector('#saved-data').value = savedata;
    //alert(link1);
  }
}
grid.on('added removed change', function (e, items) {
  let str = '';
  items.forEach(function (item) {
    str += ' (x,y)=' + item.x + ',' + item.y;
  });
  console.log(e.type + ' ' + items.length + ' items:' + str);
});

//jq

loadGrid();

$(document).ready(function () {

  $('#isAgree').change(function () {
    $('#savebtn').toggle();
    if ($(this).is(':checked')) {
      saveGrid();
    }
  });

//   $('#close').click(function () {
//       $('#myModal').modal('hide');
//       $('.grid-stack .grid-stack-item-content').removeClass('active');
//     });
    $('#save').click(function () {
      $fname = $('#fname').val();
      $txt = $('#saved-data').val();
      if ($fname === '') {
        //alert('No');
        $('#fname').addClass('border border-danger');
        return false;
      }

    });
    $("#gridcontent").click(function(){
        $( "#isAgree" ).prop( "checked", false );
        $('#savebtn').hide();
    });
    $("#cnt").mousedown(function(){
        $( "#isAgree" ).prop( "checked", false );
        $('#savebtn').hide();
    });


});

// $(document).on('click', '.nhtml', function () {
//     $mt = $(this).attr('data-code');
//     $('.active').html($mt);
//   });
  $(document).on('click', '.edit', function () {
    $(this).attr('contenteditable', true);
  });

  $(document).on(
    'dblclick',
    '.grid-stack .grid-stack-item-content',
    function () {
      $('.grid-stack .grid-stack-item-content').removeClass('active');
     // $(this).addClass('active');
      //$('#myModal').modal('show');
    }
  );



    $page='layout';
</script>
@endsection
