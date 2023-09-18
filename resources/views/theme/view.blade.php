<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
/>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="style.css" />
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/gridstack.js/0.2.4/gridstack.min.css"
/>

<script
  type="module"
  src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"
></script>
<script
  nomodule=""
  src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"
></script>
<style>

      .grid-stack {;
  min-height: 100vh !important;
        overflow: hidden;
}
</style>
<div class="grid-stack"></div>

@include('layout.gridstack')
<style>
 .grid-stack { background: #008cba; }
  .grid-stack-item-content { background-color: #ffffff; }
</style>

<div class="newWidget grid-stack-item mb-2 b1" id="gridcontent">
    <div class="grid-stack-item-content">

    </div>
  </div>

  <script>
    let grid = GridStack.init({
  cellHeight: 30,
});

let items = {!! $layout->fdata !!};

grid.load(items);

grid.movable('.grid-stack-item', false);
grid.resizable('.grid-stack-item', false);
  </script>
