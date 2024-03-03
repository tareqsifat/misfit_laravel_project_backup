<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <title>STYGEN</title>
  <style>
      .btn {
              display: inline-block;
              font-weight: 400;
              text-align: center;
              white-space: nowrap;
              vertical-align: middle;
              -webkit-user-select: none;
              -moz-user-select: none;
              -ms-user-select: none;
              user-select: none;
              border: 1px solid transparent;
              padding: 0.375rem 0.75rem;
              font-size: 1rem;
              line-height: 1.5;
              border-radius: 0.25rem;
              transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
              color: #fff;
              background: #5e2e87;
              border-bottom: 3px solid #5e2e87;
              text-decoration: none;
          }
      }
      * {
          box-sizing: border-box;
      }

      body {
          font-family: Arial, Helvetica, sans-serif;
      }

      /*---Total Html Style---*/
      html, body {
          width: 70%;
          margin: 0;
          padding: 0;
          margin-left: auto;
          margin-right: auto;
          float: none;
          overflow: hidden;
      }

      /*---Mobile View Html Style---*/
      @media only screen and (max-width: 768px) {
          html, body {
              width: auto !important;
              margin: 0;
              padding: 0;
              margin-left: auto;
              margin-right: auto;
              float: none;
              overflow: hidden;
          }
      }
      h3 {
          font-family: 'Segoe UI',sans-serif,Arial,Helvetica,Lato;
          font-size: 16px;
          line-height: 24px;
      }
      p {
          font-family: 'Segoe UI',sans-serif,Arial,Helvetica,Lato;
          font-size: 14px;
          line-height: 12px;
      }

      /*-------------------------------Clear floats after the columns---------------------*/
      section:after {
          content: "";
          display: table;
          clear: both;
      }

      /*------------------------------------Header Css------------------------------------*/
      header {
          background-color: #c2cad0;
          padding: 17px;
          text-align: center;
          color: white;
      }
      /*---Header Section Container Css---*/
      .container {

      }
      /*---Header Container Section Left Div Css---*/
      .left {
          width: 20%;
      }
      /*---Header Container Section Center Div Css---*/
      .center {
          width: 45%;
          padding-top: 17px;
      }
      /*---Header Container Section Right Div Css---*/
      .right {
          width: 25%;
          padding-top: 17px;
      }
      /*-------------------------------------Article Css---------------------------------*/
      article {
          float: left;
          padding: 0 30px;
          width: 100%;
          background-color: #f5f5f5;
          height: auto;
      }

      /*-------------------------------------Footer Css-----------------------------------*/

      /*---Footer Left Div Css---*/
      .footerleft{
          width: 100%;
      }
      /*---Footer Center Div Css---*/
      .footercenter{
          width: 50%;
      }
      /*---Footer Right Div Css---*/
      .footerright{
          width: 50%;
          padding-top: 17px;
      }

      .footerright img {
          margin-left: 5px !important;
      }
  </style>
    <body>
    <header style="background-color: #c2cad0;
    padding: 17px;
    text-align: center;
    color: white;">
        <div class="container" style="display: flex; align-items: flex-start; justify-content: space-between;">
            <div class="left" style="width: 20%;">
                <img src="https://stygen.gift/assets/frontend/img/logo/logo.png" style="width: 70px;">
            </div>
        </div>
    </header>
    <article style="float: left;
    padding: 0 30px;
    width: 100%;
    background-color: #f5f5f5;
    height: auto;">

        <p><b>{{ $buyer_details['name'] }}</b></p>
        <h3>{{ $buyer_details['title'] }}</h3>
        <h5>{{ $buyer_details['body'] }}</h5>

        <a class="btn" style="display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        color: #fff;
        background: #5e2e87;
        border-bottom: 3px solid #5e2e87;
        margin-bottom: 12px;
        text-decoration: none;" href="https://g.page/r/CUAAp1F64rPOEAg/review">Write a review</a>
    </article>
    <footer style="background-color: #c2cad0;
        padding: 10px;
        text-align: center;
        color: white;">
                <a href="https://www.facebook.com/stygen"><svg style="padding-top:10px; padding-right:5px; height: 30px; width: 30px;" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook" class="svg-inline--fa fa-facebook fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path></svg></a>
                <a href="https://stygen.gift/shop"><svg style="padding-top:10px; padding-right:5px; height: 30px; width: 30px;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="globe" class="svg-inline--fa fa-globe fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M336.5 160C322 70.7 287.8 8 248 8s-74 62.7-88.5 152h177zM152 256c0 22.2 1.2 43.5 3.3 64h185.3c2.1-20.5 3.3-41.8 3.3-64s-1.2-43.5-3.3-64H155.3c-2.1 20.5-3.3 41.8-3.3 64zm324.7-96c-28.6-67.9-86.5-120.4-158-141.6 24.4 33.8 41.2 84.7 50 141.6h108zM177.2 18.4C105.8 39.6 47.8 92.1 19.3 160h108c8.7-56.9 25.5-107.8 49.9-141.6zM487.4 192H372.7c2.1 21 3.3 42.5 3.3 64s-1.2 43-3.3 64h114.6c5.5-20.5 8.6-41.8 8.6-64s-3.1-43.5-8.5-64zM120 256c0-21.5 1.2-43 3.3-64H8.6C3.2 212.5 0 233.8 0 256s3.2 43.5 8.6 64h114.6c-2-21-3.2-42.5-3.2-64zm39.5 96c14.5 89.3 48.7 152 88.5 152s74-62.7 88.5-152h-177zm159.3 141.6c71.4-21.2 129.4-73.7 158-141.6h-108c-8.8 56.9-25.6 107.8-50 141.6zM19.3 352c28.6 67.9 86.5 120.4 158 141.6-24.4-33.8-41.2-84.7-50-141.6h-108z"></path></svg></a>
        </footer>
    </body>
</html>

