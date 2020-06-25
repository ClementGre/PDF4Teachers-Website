<div class="btn-group dropdown-div">
  <button type="button" style="padding: 0px 8px 0px 0px;" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php if($acc) $path = 'data/img/languages/' . $language . '.png';
    else $path = '../data/img/languages/' . $language . '.png';
    echo '<img style="height: 27px;" src="' . $path . '"/>'; ?>
  </button>
  <div class="dropdown-menu">

    <?php
    foreach($languages as $available){
      if($available != $language){
        if($acc) $path = 'data/img/languages/' . $available . '.png';
        else $path = '../data/img/languages/' . $available . '.png';
        echo '<a class="dropdown-item language-link" href="' . $available . '"><img style="height: 30px;" src="' . $path . '"/></a>';
      }
    }
    ?>
    </div>
</div>
