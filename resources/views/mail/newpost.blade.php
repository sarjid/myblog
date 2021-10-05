<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Post Available</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container{
            max-width: 540px;
            height: auto;
            margin: auto;
            /* border: 1px solid #333; */
            display: flex;
            flex-direction: column;
        }
        .navbar{
            max-width: 540px;
            display: flex;
            justify-content: center;
            padding: 10px 0px;
        }
        .navbar img{
            width: 100px;
            height: auto;
            margin: auto;
        }
        .post{
            padding: 0 15px;
        }
        .post img{
            position: relative;
            width: 100%;
            margin-bottom: 10px
        }
        .post .post-info{
            margin-top: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }
        .post .post-info h2{
            color: rgb(30, 165, 255);
        }
        .post-info .author {
            display: flex;
        }
        .post-info .author p{
           font-size: 16px;
           color: rgb(189, 189, 189)
        }
        .post-info .author .author-img img{
            width: 50px;hp

        }
        .post .post-body{
            margin-bottom: 20px;
        }
        .btn{
            color: #ffff;
            background: rgb(26, 144, 255);
            outline: none;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 70px;
            margin-top: 10px;
        }
        .btn:hover{
            background: rgb(19, 113, 202);
        }
        .footer{
            width: 100%;
            height: 70px;
            background: rgb(48, 48, 48);
            margin-top: 30px;
            padding: 10px 8px;
        }
        .footer p{
            color: #ffff;
            font-size: 16px;
            line-height: 1.5;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <img src="{{ asset('frontend/img') }}/logo.png" alt="logo" />
        </div>
    </div>

    <div class="container">
        <div class="post">
            <img src="{{ asset('storage/post/'.$post->image) }}" alt="post">
            <h4>{{ $post->title }}</h4>
            <div class="post-info">
                <h4></h4>
                <div class="author">
                    <div class="author-name">
                        <h3>{{ $post->name }}</h3>
                        <p>{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</p>
                    </div>
                    <div class="author-img">
                        <img src="authorImg" alt="" width="50px" height='auto'>
                    </div>
                </div>
            </div>
            {{-- <p class="post-body">{!!Str::limit($post->body, 400)!!}</p> --}}
            <a href="{{route('post.detail',$post->slug)}}" target="_blank" class="btn">Read More</a>
        </div>
        <div class="footer">
            <p>This mail is from {{ config('app.name') }}</p>
            <p>© <script>let t = new Date(); document.write(t.getFullYear());</script> {{ config('app.name') }} All rights reserved.</p>
        </div>
    </div>
</body>
</html>

