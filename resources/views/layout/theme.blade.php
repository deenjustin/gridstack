<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ url('') }}/asset/bootrap/css/bootstrap.min.css">

  <script src="{{ url('') }}/asset/bootrap/js/jquery.min.js"></script>
  <script src="{{ url('') }}/asset/bootrap/js/popper.min.js"></script>
  <script src="{{ url('') }}/asset/bootrap/js/bootstrap.bundle.min.js"></script>
    <link href="{{ url('') }}/asset/gridstack/dist/gridstack.min.css" rel="stylesheet"/>
    <script src="{{ url('') }}/asset/gridstack/dist/es5/gridstack-poly.js"></script>
    <script src="{{ url('') }}/asset/gridstack/dist/es5/gridstack-all.js"></script>
    <style>
      .grid-stack {
  background: #008cba;
  min-height: 100vh !important;
        overflow: hidden;
}
.grid-stack-item-content {
  background-color: #ffffff;
}
.side .grid-stack-item-content {
  background-color: #fafad2;
  height: 100px;
  text-align: center;
  padding-top: 25%;
  background-image: url('https://e7.pngegg.com/pngimages/535/334/png-clipart-computer-icons-add-button-logo-number-thumbnail.png');
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center;
}
.active {
  color: blue;
  background-color: gray;
}
.red {
  color: red;
}
</style>

    </style>
</head>
<body>
  <div class="row">
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
          <span>Drop here to remove!</span>
        </div>
      </div>

      <div class="newWidget grid-stack-item mb-2 b1">
        <div class="grid-stack-item-content">
          <pan class="edit"></pan>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          Do You Want to Save <input type="checkbox" id="isAgree" />
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
          <button class="btn btn-outline-info btn-block btn-sm" id="save">
            Save
          </button>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-md-10">
      <div class="grid-stack"></div>
    </div>
    <div class="col-12 p-2">
      <textarea
        id="saved-data"
        cols="100"
        rows="20"
        readonly="readonly"
        class=""
      ></textarea>
    </div>

    <!-- The Modal -->

    <!-- The Modal -->
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
  {
    x: 4,
    y: 0,
    w: 4,
    h: 4,
    // content: '2',
  },
  {
    x: 8,
    y: 0,
    w: 2,
    h: 2,
    // content: '3',
  },
  {
    x: 10,
    y: 0,
    w: 2,
    h: 2,
    // content: '4',
  },
  {
    x: 0,
    y: 2,
    w: 2,
    h: 2,
    // content: '5',
  },
  {
    x: 2,
    y: 2,
    w: 2,
    h: 4,
    // content: '6',
  },
  {
    x: 8,
    y: 2,
    w: 4,
    h: 2,
    // content: '7',
  },
  {
    x: 0,
    y: 4,
    w: 2,
    h: 2,
    // content: '8',
  },
  {
    x: 4,
    y: 4,
    w: 4,
    h: 2,
    // content: '9',
  },
  {
    x: 8,
    y: 4,
    w: 2,
    h: 2,
    // content: '10',
  },
  {
    x: 10,
    y: 4,
    w: 2,
    h: 2,
    // content: '11',
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
  let text = 'Do You Wnak Save';
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

  $('#close').click(function () {
      $('#myModal').modal('hide');
      $('.grid-stack .grid-stack-item-content').removeClass('active');
    });
    $('#save').click(function () {
      $fname = $('#fname').val();
      $txt = $('#saved-data').val();
      if ($fname === '') {
        //alert('No');
        $('#fname').addClass('border border-danger');
      } else {
        //alert("Yes");
        $('#fname').removeClass('border border-danger');
        $.post(
          'https://dummyjson.com/products/add',
          {
            title: $fname,
            body: $txt,
          },
          function (data, status) {
            alert('Data: ' + data + '\nStatus: ' + status);
          }
        );
      }
    });

});

$(document).on('click', '.nhtml', function () {
    $mt = $(this).attr('data-code');
    $('.active').html($mt);
  });
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

 </script>

</body>
</html>
