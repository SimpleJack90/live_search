<html>
<head>
<meta charset="UTF-8">
<title>Live Search with PHP and MySQL</title>

<style type="text/css">
    body{
        font-family: Arail ,sans-serif;
    }
    .search_box{
        
        
        width:300px;
        position: relative;
        display:inline-block;
        font-size:14px;
    }
    .search_box input[type="text"]{
        height:32px;
        padding: 5px 10px;
        border:1px solid #CCCCCC;
        font-size:14px;
    }
    .result{
        position:absolute;
        z-index:999;
        top:100%;
        left:0;

    }
    .search_box input[type="text"], .result{
        width:100%;
        box-sizing:border-box;
    }
    .result p {
        margin:0;
        padding:7px 10px;
        border:1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }

</style>

</head>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript">

$(document).ready(function(){

    $('.search_box input[type="text"]').on("keyup",function(){

        var inputVal=$(this).val();
        var resultDropdown=$(this).siblings(".result");

        if(inputVal.length){
            $.get(
                "backend_search.php",
                {term:inputVal}
                ).done(function(data){
                    resultDropdown.html(data);
                });
        }else{
            resultDropdown.empty();
        }


    });

    $(document).on("click",".result p",function(){
        $(this).parents(".search_box")
        .find('input[type="text"]')
        .val($(this).text());

        $($this).parent(".result").empty();

    });

});
</script>
<body>
    <div class="search_box" >
        <input type="text" autocomplete="off" placeholder="Search users...">
        <div class="result"></div>
    </div>
</body>
</html>