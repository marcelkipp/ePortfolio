<!-- HEAD START -->

<head>
  <meta charset="utf-8"/><meta charset="utf-8"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<!-- HEAD END -->

<h3>Supervisor</h3>

<?php if(!$supervisorInfo[Nachname] == ''): ?>
  <?php echo $supervisorInfo[Vorname]; ?>
  <?php echo $supervisorInfo[Nachname]; ?>
  <?php echo $supervisorInfo[Email]; ?>
<?php else: ?>
  <button data-toggle="modal" data-target="#addSupervisorModal" type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Supervisor hinzufuegen</button>
<?php endif;?>

<hr>
<h3>Zuschauerrechte</h3>

<table class="table viewer-management">

<?php if (!empty($viewerList)): ?>

  <tr>
    <th></th>
    <?php foreach ($chapterList as $chapter):?>
      <th>
        <?php echo $chapter[title]; ?>
      </th>
    <?php endforeach; ?>
  </tr>

<?php else: ?>

  <div class="alert alert-info" role="alert">Es sind derzeit keine Zuschauer in Ihrem Portfolio eingetragen. Bitte fügen die Teilnehmer hinzu Leserechte zu vergeben.</div>

<?php endif; ?>



<?php $i = 1; ?>
 <?php foreach ($viewerList as $viewer):?>
   <tr>
     <td><?php echo $viewer[Vorname].' '.$viewer[Nachname]; ?> </td>
     <?php foreach ($chapterList as $chapter):?>

      <?php $viewer_id = $viewer[viewer_id]; ?>
      <td onClick="setAccess(<?php echo $chapter[id]?>, '<?php echo $viewer_id ?>'); checkIcon('<?php echo $viewer[viewer_id]?>', <?php echo $chapter[id]; ?>);" class="righttable-inner">

        <?php if(!array_key_exists($chapter[id] ,$viewer[Chapter]) or $viewer[Chapter][$chapter[id]] == 1):?>
        <span id="icon-<?php echo $viewer[viewer_id].'-'.$chapter[id]; ?>" class="glyphicon glyphicon-ok" aria-hidden="true"></span>

        <?php elseif($viewer[Chapter][$chapter[id]] == 0):?>
          <span id="icon-<?php echo $viewer[viewer_id].'-'.$chapter[id]; ?>" class="glyphicon glyphicon-remove" aria-hidden="true"></span>

        <?php endif;?>

      </td>

      <?php endforeach; ?>

    <?php $i = 1; ?>
   </tr>
  <?php endforeach; ?>

</table>

<button data-toggle="modal" data-target="#addViewerModal" type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Zuschauer hinzufuegen</button>

<hr>
<h3>Einstellungen</h3>

<a id="portfolio-info-trigger" href="#">bearbeiten</a>
<a id="portfolio-info-saver" href="#">speichern</a>

<div class="portfolio-info-wrapper-current">
  <div><?php echo $portfolioInfo[Name]; ?></div>
  <div><?php echo $portfolioInfo[Beschreibung]; ?></div>
</div>

<div class="portfolio-info-wrapper">
  <div><input id="name-input" name="it" type="text" value="<?php echo $portfolioInfo[Name]; ?>"></div>
  <div><textarea id="beschreibung-input" name="it" type="text"><?php echo $portfolioInfo[Beschreibung]; ?></textarea></div>
</div>

<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Portfolio loeschen</button>

<!-- Modal Löschen -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Portfolio loeschen</h4>
      </div>
      <div class="modal-body" id="modalDeleteBody">

        <p id="deleteText" style="margin-bottom:30px;">
          Sind Sie sich sicher, dass Sie das Portfolio <b><?php echo $title; ?></b> loeschen wollen?</br>
          Alle Daten werden hierdurch <b>unwiderruflich</b> geloescht und koennen nicht wiederhergestellt werden.
        </p>

        <div class="deleteSuccess">
          <div><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></div>
          <p>
            Portfolio <b><?php echo $title; ?></b> geloescht
          </p>
        </div>

        <button type="button" onClick="deletePortfolio();" id="deletebtn" class="btn btn-danger">Portfolio loeschen</button>

      </div>
    </div>
  </div>
</div>


<!-- Modal Suche Supervisor -->
<div class="modal fade" id="addSupervisorModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Supervisor hinzufuegen</h4>
      </div>
      <div class="modal-body" id="modalDeleteBody">

          <p>
            <div class="input-group" style="margin-bottom:20px;">
              <div class="input-group-addon"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></div>
              <input type="text" class="form-control" id="inputSearchSupervisor" placeholder="Name des Supervisors">
            </div>

            <div id="searchResult"></div>

          </p>


      </div>
    </div>
  </div>
</div>

<!-- Modal Suche Viewer -->
<div class="modal fade" id="addViewerModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Zuschauer hinzufuegen</h4>
      </div>
      <div class="modal-body" id="modalDeleteBody">

          <p>
            <div class="input-group" style="margin-bottom:20px;">
              <div class="input-group-addon"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></div>
              <input type="text" class="form-control" id="inputSearchViewer" placeholder="Name der Person">
            </div>
portfolio-info-wrapper


      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="/studip/plugins_packages/Universitaet Osnabrueck/EportfolioPlugin/assets/js/eportfolio.js"></script>
<script type="text/javascript">

  var cid = '<?php echo $cid; ?>';

  $( document ).ready(function() {


    $('#deleteModal').on('shown.bs.modal', function () {
      $('#deleteModal').focus()
    })

    $('#portfolio-info-trigger').click( function() {
      $(this).toggleClass('show-info-not');
      $('#portfolio-info-saver').toggleClass('show-info');
      $('.portfolio-info-wrapper').toggleClass('show-info');
      $('.portfolio-info-wrapper-current').toggleClass('show-info-not');
    })

    $('#portfolio-info-saver').click( function() {
      $(this).toggleClass('show-info');
      $('#portfolio-info-trigger').toggleClass('show-info-not');
      $('.portfolio-info-wrapper').toggleClass('show-info');
      $('.portfolio-info-wrapper-current').toggleClass('show-info-not');

      var valName = $("#name-input").val();
      var valBeschreibung = $("#beschreibung-input").val();

      $.ajax({
        type: "POST",
        url: "/studip/plugins.php/eportfolioplugin/settings?cid="+cid,
        data: {'saveChanges': 1, 'Name': valName, 'Beschreibung': valBeschreibung},
        success: function(data) { }
      });

    })

    $('#inputSearchSupervisor').keyup(function() {
      var val = $("#inputSearchSupervisor").val();
      var url = "/studip/plugins.php/eportfolioplugin/livesearch";

      $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        data: {
          'val': val,
          'status': 'dozent',
          'searchSupervisor': 1,
        },
        success: function(json) {
          $('#searchResult').empty();
          _.map(json, output);
          function output(n) {
            $('#searchResult').append('<div onClick="setSupervisor(&apos;'+n.userid+'&apos;)" class="searchResultItem">'+n.Vorname+' '+n.Nachname+'<span class="pull-right glyphicon glyphicon-plus" aria-hidden="true"></span></div>');
          }
        }
      });
    });

    $('#inputSearchViewer').keyup(function() {
      var val = $("#inputSearchViewer").val();
      var url = "/studip/plugins.php/eportfolioplugin/livesearch";

      $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        data: {
          'val': val,
          'searchViewer': 1,
          'cid': cid,
        },
        success: function(json) {
          $('#searchResultViewer').empty();
            _.map(json, output);

            function output(n) {
              $('#searchResultViewer').append('<div onClick="setViewer(&apos;'+n.userid+'&apos;)" class="searchResultItem">'+n.Vorname+' '+n.Nachname+'<span class="pull-right glyphicon glyphicon-plus" aria-hidden="true"></span></div>');
            }
        }
      });
    });

  });



</script>
