<!doctype html>
<html lang="en">
<?php
include "header.php";
?>

<div class="container">
  <div class="row mt-5">
    <div class="col-12 text-justify text-dark">
      <p><b>OTIS</b> - онлайн-система обліку технічних оглядів та видачі сертифікатів для транспортних засобів. Система призначена для обліку та контролю за термінами закінчення дії відповідних документів.</p>
      <p>Також сервіс дозволяє додатково інформувати клієнтів про потребу проходження ТО або отримання сертифікатів за допомогою E-mail листів та СМС повідомлень.</p>
      <p>Система стане незамінним помічником для усіх підприємств та організацій, які надають послуги з проходження технічних оглядів та видачі сертифікатів відповідності.</p>
      <p>Якщо у Вас є запитання, пропозиції чи побажання стосовно системи OTIS - відправляйте листа на нашу електронну адресу <a href="mailto:info@otis.co.ua">info@otis.co.ua</a> і ми із задоволенням розглянемо їх.</p>
      <p>----------------<br>З повагою,<br><b>OTIS Dev Team</b></p>
    </div>
    
  </div>
  <div class="row mt-3 justify-content-sm-center">
    <div class="col-md-3 col-xs-12">
      <div class="card bg-transparent border-0">
        <div class="flip-box">
          <div class="flip-box-inner">
            <div class="flip-box-front">
              <img class="card-img-top bg-light rounded-circle w-50 mx-auto d-block shadow" src="public/img/scsi.svg" alt="Card image cap">
            </div>
            <div class="flip-box-back">
              <img class="card-img-top bg-light rounded-circle w-50 mx-auto d-block shadow" src="public/img/scsi.jpg" alt="Card image cap">
            </div>
          </div>
        </div>

        <div class="card-body text-center text-dark">
          <h5 class="card-title">Oleksandr Khorunzhiy</h5>
          <p class="card-text text-muted"></p>
          <p class="card-text text-muted">Layout/Front-end development</p>
          <a href="https://www.facebook.com/oleksandr.khorunzhyi" class="btn btn-outline-dark" rel="noopener noreferrer" target="_blank">More...</a>
        </div>
      </div>
    </div>

    <div class="col-md-3 col-xs-12">
      <div class="card bg-transparent border-0">
        <div class="flip-box">
          <div class="flip-box-inner">
            <div class="flip-box-front">
              <img class="card-img-top bg-light rounded-circle w-50 mx-auto d-block shadow" src="public/img/v1tsk.svg" alt="Card image cap">
            </div>
            <div class="flip-box-back">
              <img class="card-img-top bg-light rounded-circle w-50 mx-auto d-block shadow" src="public/img/v1tsk.jpg" alt="Card image cap">
            </div>
          </div>
        </div>

        <div class="card-body text-center text-dark flip-box-text">
          <h5 class="card-title">Viktor Kovalchuck</h5>
          <p class="card-text text-muted">Front-end/Database design</p>
          <a href="https://t.me/V1tsk" class="btn btn-outline-dark" rel="noopener noreferrer" target="_blank">More...</a>
        </div>
      </div>
    </div>

    <div class="col-md-3 col-xs-12">
      <div class="card bg-transparent border-0">
        <div class="flip-box">
          <div class="flip-box-inner">
            <div class="flip-box-front">
              <img class="card-img-top bg-light rounded-circle w-50 mx-auto d-block shadow" src="public/img/frstshmn1.svg" alt="Card image cap">
            </div>
            <div class="flip-box-back">
              <img class="card-img-top bg-light rounded-circle w-50 mx-auto d-block shadow" src="public/img/frstshmn.jpg" alt="Card image cap">
            </div>
          </div>
        </div>

        <div class="card-body text-center text-dark">
          <h5 class="card-title">Volodymir Korenha</h5>
          <p class="card-text text-muted">API/Back-end development</p>
          <a href="http://spacedesign.in.ua" class="btn btn-outline-dark" rel="noopener noreferrer" target="_blank">More...</a>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .flip-box {
    background-color: transparent;
    width: 100%;
    height: 200px;
    perspective: 1000px;
    /* Remove this if you don't want the 3D effect */
  }

  /* This container is needed to position the front and back side */
  .flip-box-inner {
    position: relative;
    width: 100%;
    height: 100%;
    text-align: center;
    transition: transform 0.5s;
    transform-style: preserve-3d;
  }

  /* Do an horizontal flip when you move the mouse over the flip box container */
  .flip-box:hover .flip-box-inner {
    transform: rotateY(180deg);
  }

  /* Position the front and back side */
  .flip-box-front,
  .flip-box-back {
    position: absolute;
    width: 100%;
    height: 100%;
    -webkit-backface-visibility: hidden;
    /* Safari */
    backface-visibility: hidden;
  }

  /* Style the front side (fallback if image is missing) */
  .flip-box-front {
    color: black;
  }

  /* Style the back side */
  .flip-box-back {
    color: white;
    transform: rotateY(180deg);
  }

  @media (min-width: 320px) {
    .flip-box {
      height: 153px;
    }
  }

  @media (min-width: 390px) {
    .flip-box {
      height: 164px;
    }
  }

  @media (min-width: 420px) {
    .flip-box {
      height: 184px;
    }
  }

  @media (min-width: 463px) {
    .flip-box {
      height: 230px;
    }
  }

  @media (min-width: 551px) {
    .flip-box {
      height: 250px;
    }
  }

  @media (min-width: 767px) {
    .flip-box {
      height: 130px;
    }
  }

  @media (min-width: 1200px) {
    .flip-box {
      height: 150px;
    }
  }
  .text-muted {
    color: #6c757d!important;
    font-size: 0.8em;
}
</style>


<?php
include "footer.php";
?>
</body>

</html>