<div class="btn-group dropdown-div language-div">
  <button type="button" style="padding: 0px 8px 0px 0px; background-color: rgba(1, 1, 1, 0.2); border: none;" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
