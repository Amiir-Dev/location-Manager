<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_TITLE ?></title>
    <link href="<?= site_url("assets/img/favicon.png") ?>" rel="shortcut icon">

    <link rel="stylesheet" href="<?= site_url("assets/css/styles.css") ?>">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

</head>


<body>
    <div class="main">
        <div class="head">
            <div class="search-box">
                <input type="text" id="search" placeholder="دنبال کجا می گردی؟" autocomplete="none">
                <div class="clear"></div>
                <div class="search-results" style="display: none;"></div>
            </div>
        </div>
        <div class="mapContainer">
            <div id="map"></div>
        </div>
        <img src="assets/img/current.png" class="currentLoc">
    </div>

    <div class="modal-overlay" style="display: none;">
        <div class="modal">
            <span class="close">x</span>
            <h3 class="modal-title">ثبت لوکیشن</h3>
            <div class="modal-content">
                <form id='addLocationForm' action="<?= site_url("process/addLocation.php") ?>" method="post">
                    <div class="field-row">
                        <div class="field-title">مختصات</div>
                        <div class="field-content">
                            <input type="text" name='lat' id="lat-display" readonly style="width: 160px;text-align: center;">
                            <input type="text" name='lng' id="lng-display" readonly style="width: 160px;text-align: center;">
                        </div>
                    </div>
                    <div class="field-row">
                        <div class="field-title">نام مکان</div>
                        <div class="field-content">
                            <input type="text" name="title" id='l-title' placeholder="مثلا: دانشگاه صنعتی شریف">
                        </div>
                    </div>
                    <div class="field-row">
                        <div class="field-title">نوع</div>
                        <div class="field-content">
                            <select name="type" id='l-type'>
                                <?php foreach (locationTypes as $key => $value) : ?>
                                    <option value="<?= $key ?>"><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div >
                            <div class="field-content" style=" margin: 5px 200px 0 0">
                                نام شما <input type="text" name="user_name" id='u-name' style="width : 200px; margin-left:30px">
                                ایمیل شما <input type="email" name="user_email" id='u-email' style="width : 200px">
                            </div>
                        </div>


                    </div>
                    <div class="field-row">
                        <div class="field-title">ذخیره نهایی</div>
                        <div class="field-content">
                            <input type="submit" value=" ثبت ">
                        </div>
                    </div>
                    <div class="ajax-result"></div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= site_url("assets/js/jquery.min.js") ?>"></script>
    <script src="<?= site_url("assets/js/scripts.js") ?>"></script>
    <script>
        <?php if ($location) : ?>
            L.marker([<?= $location->lat ?>, <?= $location->lng ?>]).addTo(map).bindPopup("ّ<?= $location->title ?>").openPopup();
        <?php endif; ?>


        $(document).ready(function() {
            $('img.currentLoc').click(function() {
                locate();
            });

            $('input#search').keyup(function() {
                const input = $(this);
                const searchResult = $('.search-results');
                searchResult.html('در حال جستجو ...');
                $.ajax({
                    url: '<?= BASE_URL . 'process/search.php' ?>',
                    method: 'POST',
                    data: {
                        keyword: input.val()
                    },
                    success: function(response) {
                        if (response) {
                            searchResult.slideDown().html(response);
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>