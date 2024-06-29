<?php
function msg($message)
{
  echo "<div class='fixed-top d-flex justify-content-center align-items-center w-100'>
        <div class='toast show'>
          <div class='toast-header'>
           <img src='LOGO/LOGO.JPG' class='rounded me-auto' width=150' alt='GROW WITH FARM'>
            <button type='button' class='btn-close'  data-bs-dismiss='toast'></button>
          </div>
          <div class='toast-body fs-5'>$message</div>
        </div>
      </div>";
}
