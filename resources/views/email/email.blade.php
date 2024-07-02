<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>email</title>

    <style>
        * {
            direction: rtl;
            box-sizing: border-box;

        }

        a{
            text-decoration: none;
            color: #9A29CF !important;
        }
        
        .wrapper {
            width: 60% !important;
            margin: 10px auto !important;
        }
        
        .header,
        .footer {
            padding: 15px;
            background-color: #F2F2F2 !important;
        }

        .center{
           text-align: center;
        }
        
        .header h1 {
            color: #9A29CF;
            font-weight: bolder;
            font-size: 2.2rem;
        }
        
        .content {
            padding: 20px !important;
        }
        
        .content h4,
        .content h4 span
        .content h4 span a {
            font-weight: bolder;
            font-size: 1.2rem;
            color: #9A29CF;
            margin: 10px 0 !important;
        }
        
        .content p {
            text-align: justify;
            line-height: 24px;
            font-size: 0.8rem;
            color: #656565;
        }
        
        .content .btn {
            margin-top: 20px;
            display: inline-block;
            background-color: #9A29CF;
            border: 1px solid #e9cff5;
            border-radius: 14px;
            font-weight: bold;
            padding: 10px !important;
            color: #F2F2F2 !important;
            transition: all 0.3s ease-in-out;
        }
        
        .content .btn:hover {
            background-color: #e9cff5;
            color: #9A29CF !important;
        }
        
        .footer {
            margin-top: 10px;
        }
        
        .footer p {
            color: #828282;
            font-weight: 700;
            text-align: center;
        }
        @media screen and (max-width:576px) {
            .wrapper{
                width: 100% !important;
            }
            .header h1 {
            font-size: 0.9rem;
            }
            .content h4,
            .content h4 span,
            .content h4 span a ,
            .content .btn,
            .content p {
                font-size: 0.7rem;
            }
        }     
        </style>
</head>

<body dir="rtl">

    <section class="wrapper">

        <div class="header">
           <h1 class="center">تست پروژه</h1>
        </div>
        <div class="content">
            <h4>
                {{ $details['title'] }}
                <br>
                <span>{{ $from[0]['address'] }}</span>
            </h4>
            <p>
                {!! $details['body'] !!}
            </p>

        </div>
        <div class="footer">
            <p>تمامی حقوق محفوظ است</p>
        </div>
    </section>

</body>

</html>