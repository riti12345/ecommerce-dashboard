	
<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $session_data = get_session_data();
?>
</div>

  <!-- let e = document.createElement('div');
let shadowRoot = e.attachShadow({mode: 'closed'});
console.assert(e.shadowRoot == null);   -->
  <div id="demo-toast-example" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action" type="button"></button>
  </div>
  
  <script src="<?php echo base_url().'assets/js/material.js';?>"></script>
  <script src="<?php echo base_url().'assets/js/material.select.js';?>"></script>
  <script src="<?php echo base_url().'assets/sweetalert-master/dist/sweetalert.min.js';?>"></script>
  
  <script src="<?php echo base_url().'assets/js/moment.js';?>"></script>
  <script src="<?php echo base_url().'assets/js/pikaday.js';?>"></script>

  <script>
      var picker = new Pikaday({
          field: document.getElementById('datepicker'),
          format: 'YYYY-MM-DD',
          onSelect: function() {
              console.log(this.getMoment().format('Do MMMM YYYY'));
          }
      });
      var picker = new Pikaday({
          field: document.getElementById('datepicker1'),
          format: 'YYYY-MM-DD',
          onSelect: function() {
              console.log(this.getMoment().format('Do MMMM YYYY'));
          }
      });
      var picker = new Pikaday({
          field: document.getElementById('datepicker2'),
          format: 'YYYY-MM-DD',
          onSelect: function() {
              console.log(this.getMoment().format('Do MMMM YYYY'));
          }
      });
  </script>
</body>
</html>
