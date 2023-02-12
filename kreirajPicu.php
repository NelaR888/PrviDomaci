<?php
    include 'header.php';
?>

<div class='container mt-2 mb-5'>
    <h1 class='text-center text-dark'>
        Dodaj novu picu
    </h1>
    <div class='row mt-2 d-flex justify-content-center'>
        <div class='col-7'>
            <form id='forma'>
                <div class='form-group'>
                    <label for="naziv">Naziv</label>
                    <input required name="naziv" class="form-control" type="text" id="naziv">
                </div>
                <div class='form-group'>
                    <label for="cena">Cena</label>
                    <input required name="cena" class="form-control" type="number" min="1" id="cena">
                </div>

                <div class='form-group'>
                    <label for="tip_kore">Tip kore</label>
                    <select required name='tip_kore' class="form-control" id="tip_kore"></select>
                </div>
                <div class='form-group'>
                    <label for="vrsta_pice">Vrsta pice</label>
                    <select required name="vrsta_pice" class="form-control" id="vrsta_pice"></select>
                </div>
                <div class='form-group'>
                    <label for="slika">Slika</label>
                    <input required name="slika" class="form-control-file" type="file" id="slika">
                </div>
                <div class='form-group'>
                    <label for="opis">Opis</label>
                    <textarea required name="opis" class="form-control" type="number" id="opis"></textarea>
                </div>
                <button type="submit" class="btn btn-primary form-control" id="dodaj">Dodaj</button>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

    $(function () {
        ucitajOptions('server/tip_kore/read.php', 'tip_kore');
        ucitajOptions('server/vrsta_pice/read.php', 'vrsta_pice');
        $('#forma').submit(e => {

            e.preventDefault();

            const naziv = $('#naziv').val();
            console.log( 'naziv: ' + naziv);
            const cena = $('#cena').val();
            console.log( 'cena: ' + cena);
            const tip_kore = $('#tip_kore').val();
            console.log( 'tip_kore: ' + tip_kore);
            const vrsta_pice = $('#vrsta_pice').val();
            console.log( 'vrsta_pice: ' + vrsta_pice);
            const opis = $('#opis').val();
            console.log( 'naziv: ' + naziv);
            const slika = $("#slika")[0].files[0];
            console.log( 'naziv: ' + naziv);
            const fd = new FormData();
            fd.append("slika", slika);
            fd.append("naziv", naziv);
            fd.append("opis", opis);
            fd.append("cena", cena);
            fd.append("id_tip_kore", tip_kore);
            fd.append("id_vrsta_pice", vrsta_pice);
            $.ajax( 
                {
                    url: "./server/pica/create.php",
                    type: 'post',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        if (!data.status) {
                            alert(data.error);
                        }

                    },

                }
            )
        })
    })

    function ucitajOptions(url, htmlElement) {
        $.getJSON(url).then(res => {
            if (!res.status) {
                alert(res.error);
                return;
            }
            for (let element of res.kolekcija) {
                $('#' + htmlElement).append(`
                    <option value="${element.id}">
                        ${element.naziv}
                        </option>
                `)
            }
        })
    }

</script>
<?php
    include 'footer.php';
?>  