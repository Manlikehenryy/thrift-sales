<style>

    a{
        text-decoration: none !important;
        color: black !important;
    }
    .shop-btn{
        width: 200px;
        height: 50px;
        background: #4FA8A8;
        border: 3px solid #4FA8A8;
        border-radius: 5px;
        color: #fff;
        margin-top: 20px;
    }
    .category-container{
        margin: auto;
        width:100%;
    }
    .flex-container{
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        width:80%;
    }
    .header-container{
        margin: auto;
       text-align: center;
        width:80%;
    }
    .back-g{
        width: 100%;
        height: 500px;
    }
    .back-g img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .box img{
        object-fit: cover;
    }
    .box{
        box-shadow: 0 0 5px rgba(0, 0,0,0.12);
        border-radius: 0 0 8px 8px;
    }
    .card-head{
        /* margin: 10px 0 0 10px; */
        padding: 10px 0 10px 10px;
        font-size: 17px;
        background-color: #cdefef;
    }
    .card-title,.price{
        font-size: 16px;
    }
    .old-price{
        font-size: 14px;
    }
    .card-items{
        margin-top: 10px;
        text-align: left;
        padding-left: 10px;
    }
    .card-img{
        width: 200px;
        height: 190px;
        position: relative;
    }
    .card-discount{
    background-color: #cce1e1;
    color: #319595;
    font-size: 13px;
    font-weight: 700;
    padding: 0 2.5px 2.5px 2.5px!important;
    position: absolute;
    right: 10px;
    top: 10px;
}
    .arrow{
        color:#fff;
        z-index: 12;
        font-size: 20px;
    }
    .left-btn,.right-btn{
      cursor: pointer;
      width: 40px;
      height: 40px;
      background-color: #000;
      opacity: 0.45;
      position: absolute;
      z-index: 10;
      border-radius: 50%;
      top: 50%;
      transform: translateY(-50%);
      text-align: center;
      padding-top: 5px;
      display: none;
    }
    .left-btn{
        left: 0px;
    }
    .right-btn{
       right:0px;
    }
    .swipe-cont{
        position: relative;
        /* height: 350px; */
        margin: 20px 20px;
        width:66.5%;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    }
    .swipe{
        position: relative;
        height: 300px;
        width: 98.7%;
        display: flex;
        overflow: hidden;
        background-color: #fff;
    }
    .center-box{
        margin: 30px auto;
        width: 81%;
    }
    .cardbox{
        position: absolute;
        top: 0;
        width: 200px;
        height: 90%;
        margin: 10px;
        background-color: #fff;
        transition: 0s ease-in;
        text-align: center;
        font-size: 30px;
    }
    @media (max-width:991px){
    .card-head{
        /* margin: 10px 0 0 0; */
        padding-left: 35px;
    }
    .left-btn,.right-btn{
      display: none;
    }
    .swipe{
       margin: 0 auto;
       width: 90%;
    }
    .swipe-cont{
        width: 100%;
    }
    }
</style>


    @include('components.navbar')

        <!-- Header-->
        {{-- <header class="bg-dark py-5">
      <div id="outer-container">
        <div class="container px-4 px-lg-5 my-5 ">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style </h1>
                <a href=""><button class="shop-btn">START SHOPPING</button></a>
            </div>
        </div>
      </div>
        </header> --}}
          <div class="back-g">
            <img src="{{asset('images/e-comm.jpg')}}" alt="">
          </div>

        <!-- Section-->
        <section class="py-5">


            <div class="category-container">

                <div class="header-container">
                    <h4 style="margin-left:0px;font-weight:700;font-size:25px;">BROWSE CATEGORIES</h4>
                </div>

                @php
                $count=0;
                @endphp

                <div  class="flex-container">
                    @if (count($categories) !== 0)
                    @foreach ($categories as $category )
                       @foreach ($posts as $post)
                          @if ($post->category_id === $category->id)
                          <a class="" href="/browse/categories/cat-{{$count+=1}}">
                          <div style="width: 200px;height:200px;margin:10px;" class="box">
                            <img style="border-radius: 8px 8px 0 0;" width="200px" height="150px" src={{asset('images/'.$category->path)}} alt="">
                            <div style="width: 200px;height:50px; background:#fbfbf3;border-radius:0 0 8px 8px;text-align:center;padding-top:10px;font-weight:600;">{{$category->title}}</div>
                        </div>
                             </a>
                             @break
                          @endif
                       @endforeach
                    @endforeach
                </div>
                @endif




            </div>

        </section>

        <div class="swipe-cont center-box">
            <div id="leftBtn" class="left-btn"><div class="arrow"><</div></div>
            <div id="rightBtn" class="right-btn"><div class="arrow">></div></div>
            <h5 class="card-head">Latest deals</h5>
            <div class="swipe">
               @foreach ($latest_posts as $latest_post)
               <a href="/shop/item/{{$latest_post->id}}">
               <div class="cardbox">
                <div class="card-img">
                    <div class={{$latest_post->old_amount?'card-discount':''}}>{{$latest_post->old_amount?round(((($latest_post->current_amount/$latest_post->old_amount)*100)-100)).'%': ''}}</div>

                 <img style="object-fit:cover;border-radius:4px 4px 0 0" width="200px" height="190px" src="{{asset('images/'.$latest_post->path)}}" alt="">
                </div>
                 <div class="card-items">
                     <div class="card-title">

                     @if (strlen($latest_post->title)<18)
                     {{$latest_post->title}}
                     @elseif ($latest_post->title)
                     {{substr($latest_post->title,0,18).'...'}}
                    @endif
                     </div>
                     <div class="price">
                         {{'₦'.$latest_post->current_amount}}
                     </div>
                     <div class="old-price">
                         <strike><small>{{$latest_post->old_amount?'₦'.$latest_post->old_amount:''}}</small></strike>
                     </div>
                 </div>
               </div>
                </a>
               @endforeach

           </div>
        </div>


@include('components.footer')





<script>
    let cardBox = document.querySelectorAll('.cardbox');
    let swipe = document.querySelector('.swipe');
    let leftBtn = document.querySelector('#leftBtn')
    let rightBtn = document.querySelector('#rightBtn')
    // let countBoxes = cardBox.length;
    let rightTurn = 0;
    let leftTurn = 0;


    let pressed = false;
    let startx;
    let x;
    let position = 0;
    const positionArray = [];
    let movements=[]


    document.querySelector('.swipe-cont').addEventListener('mouseenter',function () {
        leftbtnBoundary()
        rightbtnBoundary()
    })

    document.querySelector('.swipe-cont').addEventListener('mouseleave',function () {
        rightBtn.style.display = 'none';
        leftBtn.style.display = 'none';
    })


    // SETS INITIAL POSITION FOR THE BOXES
    cardBox.forEach((val,i)=>{
        val.style.left += `${position}px`;
        positionArray[i] = position;
        position += 210;
    })


    if (screen.width>=1000) {
        cardBox.forEach((val,i)=>{
        val.style.transition += '0.5s ease-out';
    })
    }

    // leftbtnBoundary()
    // rightbtnBoundary()

    leftBtn.addEventListener('click',function() {
    if (parseInt(cardBox[0].style.left)<0) {
        rightTurn -= 4
       let value = movements.shift();
        cardBox.forEach((val,index)=>{
        val.style.left = `${positionArray[index]+(210*value)}px`;
      })
      cardBox.forEach((val,index)=>{
        positionArray[index] = parseInt(val.style.left);
      })
    }

    leftbtnBoundary()
    rightbtnBoundary()
    })



    rightBtn.addEventListener('click',function() {
    rightTurn += 4;
    if (rightTurn<cardBox.length) {
      if (!(cardBox.length-rightTurn<4)) {
        cardBox.forEach((val,index)=>{
        val.style.left = `${positionArray[index]-210*4}px`;
      })
      movements.push(4);
      cardBox.forEach((val,index)=>{
        positionArray[index] = parseInt(val.style.left);
      })
      }
      else{
        cardBox.forEach((val,index)=>{
        val.style.left = `${positionArray[index]-210*(cardBox.length-rightTurn)}px`;
      })
      cardBox.forEach((val,index)=>{
        positionArray[index] = parseInt(val.style.left);
      })
      movements.push(cardBox.length-rightTurn);
      }
    }
    else{
        rightTurn -= 4;
    }

    leftbtnBoundary()
    rightbtnBoundary()
    })

    // EVENT LISTENER FOR TOUCHSTART, INITIALIZES START POSITION
    cardBox.forEach((val,i) => {
        cardBox[i].addEventListener('touchstart',function(e) {
    startx = e.touches[0].clientX;
    })
    });



// EVENT LISTENER FOR TOUCHMOVE
cardBox.forEach((val,i) => {
    cardBox[i].addEventListener('touchmove',function(e){
   if (cardBox.length>=3&&screen.width<=630) {
    var touch = e.touches[0];

var change = touch.clientX - startx;

// CHECKS IF THE SWIPE DIRECTION IS FORWARD
if(change<0){
 for (let i = 0; i < cardBox.length; i++) {
cardBox[i].style.left = `${positionArray[i]+change}px`;
}
rightBoundary();
}

// CHECKS IF THE SWIPE DIRECTION IS BACKWARD
else{
for (let i = 0; i < cardBox.length; i++) {
cardBox[i].style.left = `${change+positionArray[i]}px`;
}

leftBoundary();
}

e.preventDefault();
   }
   else if (cardBox.length>=5&&screen.width<=1024) {
    var touch = e.touches[0];

var change = touch.clientX - startx;

// CHECKS IF THE SWIPE DIRECTION IS FORWARD
if(change<0){
 for (let i = 0; i < cardBox.length; i++) {
cardBox[i].style.left = `${positionArray[i]+change}px`;
}
rightBoundary();
}

// CHECKS IF THE SWIPE DIRECTION IS BACKWARD
else{
for (let i = 0; i < cardBox.length; i++) {
cardBox[i].style.left = `${change+positionArray[i]}px`;
}

leftBoundary();
}

e.preventDefault();
   }
})


});



    // EVENT LISTENER FOR TOUCHEND
    cardBox.forEach((val,i) => {
        cardBox[i].addEventListener('touchend',function(e){
        var change = startx - e.changedTouches[0].clientX

    // CHECKS IF THE SWIPE DIRECTION IS FORWARD
       if (change>0) {

    // CHECKS IF THE BOX HAS BEEN SWIPED HALFWAY OUT OF THE SCREEN AND IF ITS NOT THE LAST ELEMENT
           if (change>210/2) {
           for (let i = 0; i < positionArray.length; i++) {
                positionArray[i] = parseInt(cardBox[i].style.left);
            }
           }
           // ELSE ROLLBACK TO PREV POSITION
           else{
            for (let i = 0; i < cardBox.length; i++) {
                cardBox[i].style.left = `${positionArray[i]}px`;
            }
           }

       }

    // CHECKS IF THE SWIPE DIRECTION IS BACKWARD
       else{
        if (-change>210/2) {
           for (let i = 0; i < positionArray.length; i++) {
                positionArray[i] = parseInt(cardBox[i].style.left);
            }
           }

    // ELSE ROLLBACK TO PREV POSITION
         else{
            for (let i = 0; i < cardBox.length; i++) {
                cardBox[i].style.left = `${positionArray[i]}px`;
            }
         }
       }


    e.preventDefault();

    })


    });

    function rightbtnBoundary() {
    if (parseInt(cardBox[cardBox.length-1].style.left)<=630) {
      rightBtn.style.display = 'none';
    }
    else{
        rightBtn.style.display = 'block';
    }
    }

    function leftbtnBoundary() {
    if (parseInt(cardBox[0].style.left)>=0) {
        leftBtn.style.display = 'none';
    }
    else{
        leftBtn.style.display = 'block';
    }
    }

    function rightBoundary() {
    if (cardBox[cardBox.length-1].getBoundingClientRect().right<swipe.getBoundingClientRect().right) {
       let width = swipe.getBoundingClientRect().width - cardBox[cardBox.length-1].getBoundingClientRect().width - 20;
        for (let k = cardBox.length-1; k >= 0; k--) {
            cardBox[k].style.left = `${width}px`;
            width -= 210;
        }
        cardBox[cardBox.length-1].style.left = `${swipe.getBoundingClientRect().width - cardBox[cardBox.length-1].getBoundingClientRect().width - 20}px`
    }
    }

    function leftBoundary() {
    if (parseInt(cardBox[0].style.left)>0) {
       let width = 0;
        for (let k = 0; k < cardBox.length; k++) {
            cardBox[k].style.left = `${width}px`;
            width += 210;
        }
    }
    }
    </script>
