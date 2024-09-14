<link href="https://fonts.googleapis.com/css?family=Montserrat:700,900" rel="stylesheet">
<style type="text/css">
    .notfound .notfound-500 {
      position: relative;
      height: 200px;
    }

    .notfound .notfound-500 h1 {
      font-family: 'Montserrat', sans-serif;
      position: absolute;
      left: 20%;
      top: 50%;
      -webkit-transform: translate(-50%, -50%);
          -ms-transform: translate(-50%, -50%);
              transform: translate(-50%, -50%);
      font-size: 220px;
      font-weight: 900;
      margin: 0px;
      color: #000000;
      text-transform: uppercase;
      letter-spacing: 10px;
    }


    @media only screen and (max-width: 767px) {
      .notfound .notfound-500 h1 {
        font-size: 182px;
      }
    }

    @media only screen and (max-width: 480px) {
      .notfound .notfound-500 {
        height: 146px;
      }
      .notfound .notfound-500 h1 {
        font-size: 146px;
      }
      .notfound h2 {
        font-size: 16px;
      }
      .notfound .home-btn, .notfound .contact-btn {
        font-size: 14px;
      }
    }

</style>

<x-layout>
    <x-slot name="title">Anda tidak memiliki akses</x-slot>
    <x-slot name="card_title">{{ $exception }}</x-slot>
    <div class="card-body">
        <div class="notfound">
        <div class="notfound-500">
            <h1>403</h1>
        </div>
        </div>
        </div>
    </div>
</x-layout>
