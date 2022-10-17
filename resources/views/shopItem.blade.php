
   @include('components.navbar')
   <style>
    .discount{
    background-color: #cce1e1;
    color: #319595;
    font-size: 15px;
    font-weight: 700;
    padding: 2.5px 3.5px 2.5px 3.5px!important;
    position: absolute;
    top: 1px;
    left: 75px;
}
.old-amount{
    position: relative;
}
.total-btn{
    width: 90%;
    height: 50px;
    background-color: #4FA8A8;
    border: none;
    border-radius: 5px;
    color: #fff;
    position: absolute;
    left: 45%;
    transform: translateX(-50%);
    bottom: -122px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
.total-btn:hover{
    background-color: #4FA8A8;
}
#img-1,#img-2,#img-3{
  margin-right: 10px;
  cursor: pointer;
  object-fit: cover;
}
#main-img{
    object-fit: cover;
}
#img-2,#img-3{
  opacity: 0.5;
}
.add-cart{
        margin-right: 10px;
    }
    .btn-container{
        width: 180px;
        height: 40px;
        position: absolute;
        bottom: -122px;
        left: 15%;
        transform: translateX(-50%);
        padding-left: 7px;
    }
    .btn-plus,.btn-minus{
    background-color:#4FA8A8;
    border: none;
    padding: 0 10px;
    border-radius: 5px;
    font-size: 26px;
    color: #fff;
    margin: 0 17px;
}
.btn-minus{
    padding: 0 13px;
    /* opacity: 0.4; */
}
.card-head{
        /* margin: 10px 0 0 10px; */
        padding: 10px 0 10px 10px;
        font-size: 17px;
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
    .swipe-cont,.recent-cont{
        position: relative;
        /* height: 350px; */
        margin: 20px 50px 60px 50px;
        width:76.5%;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    }

    .swipe,.recent{
        position: relative;
        height: 300px;
        width: 98.7%;
        display: flex;
        /* margin: 0 0px 0 0; */
        /* padding: 10px; */
        overflow: hidden;
        background-color: #fff;
    }
    .center-box{
        margin: 30px auto;
        width: 81%;
    }
    .cardbox,.recentbox{
        position: absolute;
        top: 0;
        width: 200px;
        height: 94%;
        margin: 10px;
        background-color: #fff;
        transition: 0s ease-in;
        text-align: center;
        font-size: 30px;
    }
    .cardbox:hover,.recentbox:hover{
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    .height{
        height: 360px;
    }
    @media(max-width:1024px){
        .height{
        height: 200px;
    }
    .reduce{
        height: 720px;
    }
        .total-,.btn-container{
    bottom: -10px;
}
 .card-head{
        padding-left: 7.2%;
    }
    .left-btn,.right-btn{
      display: none;
    }
    .swipe,.recent{
       margin: 0 auto;
       width: 90%;
    }
    .swipe-cont,.recent-cont{
        width: 100%;
        margin:20px 0 !important;
    }
    }
    @media(max-width:768px){
        .total-btn{
    width: 95%;
    bottom: -40px;
}
.btn-container{
    bottom: -40px;
    }
h1.display-5.fw-bolder{
    font-size: 20px ;
}
#main-img{

}
    }


   </style>
     <!-- Product section-->
     <section  class="py-5 reduce">
        <div class="container px-4 px-lg-5 my-5">
            <div style="width:90%;" class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" id="main-img" width="300px" height="300px" src={{asset('images/'.$post->path)}} alt="..." />
                   <div style="display: flex;margin:10px 0;">
                    <img id="img-1" src="{{asset('images/'.$post->path)}}" width="50px" height="50px" alt="">
                        @if ($post->path2)
                        <img id="img-2" src="{{asset('images/'.$post->path2)}}" width="50px" height="50px" alt="">
                        @endif
                        @if ($post->path3)
                        <img id="img-3" src="{{asset('images/'.$post->path3)}}" width="50px" height="50px" alt="">
                        @endif
                    </div>
                </div>
                <div  class="col-md-6 height" >
                    {{-- <div class="small mb-1">SKU: BST-498</div> --}}
                    <h1 class="display-5 fw-bolder">{{$post->title}}</h1>
                    <div class="fs-5 mb-5 ">
                        <div>{{'₦'.$post->current_amount}}</div>

                        <div class="old-amount">
                            <span class="text-decoration-line-through">{{$post->old_amount?'₦'.number_format($post->old_amount):''}}</span>
                            <span class={{$post->old_amount?'discount':''}}>{{$post->old_amount?round(((($post->current_amount/$post->old_amount)*100)-100)).'%': ''}}</span>
                        </div>
                    </div>
                    <p class="lead">{{$post->description}}</p>
                        @csrf
                        <div class="d-flex" style="position: relative;">

                            @if (Auth::check()&&$cart_qty)
                            <button id="cart-btn" onclick="store(<?=$post->id?>)" class="total-btn btn btn-outline-dark flex-shrink-0 hide" type="submit">
                                <img class="add-cart" width="23" src="{{asset('images/add-cart.png')}}" alt="">
                                Add to Cart
                            </button>
                            <div id="btn-contain" class="btn-container">
                                <button onclick="minus(<?=$post->id?>)" class="btn-minus">-</button>
                               <span id="item-qty" class="item-qty">{{$cart_qty}}</span>
                                <button onclick="add(<?=$post->id?>)" class="btn-plus">+</button>
                             </div>


                             @elseif ($cart_session&&isset($cart_session[$post->id]))
                             <button id="cart-btn" onclick="store(<?=$post->id?>)" class="total-btn btn btn-outline-dark flex-shrink-0 hide" type="submit">
                                <img class="add-cart" width="23" src="{{asset('images/add-cart.png')}}" alt="">
                                Add to Cart
                            </button>
                            <div id="btn-contain" class="btn-container">
                                <button onclick="minus(<?=$post->id?>)" class="btn-minus">-</button>
                               <span id="item-qty" class="item-qty">{{$cart_session[$post->id]['qty']}}</span>
                                <button onclick="add(<?=$post->id?>)" class="btn-plus">+</button>
                             </div>


                             @else
                             <button id="cart-btn" onclick="store(<?=$post->id?>)" class="total-btn btn btn-outline-dark flex-shrink-0" type="submit">
                                <img class="add-cart" width="23" src="{{asset('images/add-cart.png')}}" alt="">
                                Add to Cart
                            </button>
                            <div id="btn-contain" class="btn-container hide">
                                <button onclick="minus(<?=$post->id?>)" class="btn-minus">-</button>
                               <span id="item-qty" class="item-qty">{{$cart_qty}}</span>
                                <button onclick="add(<?=$post->id?>)" class="btn-plus">+</button>
                             </div>

                            @endif





                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related items section-->
    {{-- <div style="display: flex;align-items:center;flex-direction:column;" class="outer-con"> --}}

        <div class="swipe-cont">
            <div id="leftBtn" class="left-btn"><div class="arrow"><</div></div>
            <div id="rightBtn" class="right-btn"><div class="arrow">></div></div>
            <h5 style="background-color: #cdefef;" class="card-head">Latest deals</h5>
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

        @if (Session::has('views'))
        <div class="recent-cont">
            <div id="recentleftBtn" class="left-btn"><div class="arrow"><</div></div>
            <div id="recentrightBtn" class="right-btn"><div class="arrow">></div></div>
            <h5 style="background:#f8f8cc;" class="card-head">Recently viewed</h5>
            <div class="recent">
               @foreach (Session::get('views') as $post)
              <a href="/shop/item/{{$post->id}}">
                <div class="recentbox">
                    <div class="card-img">
                        <div class={{$post->old_amount?'card-discount':''}}>{{$post->old_amount?round(((($post->current_amount/$post->old_amount)*100)-100)).'%': ''}}</div>

                     <img style="object-fit:cover;border-radius:4px 4px 0 0" width="200px" height="190px" src="{{asset('images/'.$post->path)}}" alt="">
                    </div>
                     <div class="card-items">
                         <div class="card-title">

                         @if (strlen($post->title)<18)
                         {{$post->title}}
                         @elseif ($post->title)
                         {{substr($post->title,0,18).'...'}}
                        @endif
                         </div>
                         <div class="price">
                             {{'₦'.$post->current_amount}}
                         </div>
                         <div class="old-price">
                             <strike><small>{{$post->old_amount?'₦'.$post->old_amount:''}}</small></strike>
                         </div>
                     </div>
                   </div>
              </a>
               @endforeach


           </div>
        </div>

        @endif

        {{-- </div> --}}
    <div id="success" class="alert alert-success hide">
    </div>

    <div id="danger" class="alert alert-danger hide">
    </div>

    @include('components.footer')


    <script>
        let modal = document.querySelector('.alert');

        function store(val) {
        $.ajax({
           type:'GET',
           url:`/store/cart/${val}/item`,
           success:function(res) {
            $('#success').text('Ítem added to cart');
            $('#success').show();
            $(`#btn-contain`).show();
            $(`#item-qty`).text(res.qty);
            $('.cart-badge').show();
            $('.cart-badge').text(res.total_qty);
            $(`#cart-btn`).hide();
       setTimeout(() => {
          modal.classList.add('slideout');
       }, 1500);
       setTimeout(() => {
          modal.classList.remove('slideout');
          $('#success').hide();
       }, 2000);
           }
        })
   }

   function add(val) {
        $.ajax({
           type:'GET',
           url:`/store/cart/${val}/item`,
           success:function(res) {
            $('#success').text('Ítem added to cart');
            $('#success').show();
            $(`#item-qty`).text(res.qty);
            $('.cart-badge').text(res.total_qty);
       setTimeout(() => {
          modal.classList.add('slideout');
       }, 1500);
       setTimeout(() => {
          modal.classList.remove('slideout');
          $('#success').hide();
       }, 2000);
           }
        })
   }

   function minus(val) {

        $.ajax({
           type:'GET',
           url:`/decrease/cart/${val}/item`,
           success:function(res) {
            $('#danger').text('Ítem removed from cart');
            $('#danger').show();
            if (res.qty>0) {
               $(`#item-qty`).text(res.qty);
            }
            else{
               $(`#btn-contain`).hide();
            $(`#cart-btn`).show();
            }
            if (res.total_qty>0) {
               $('.cart-badge').text(res.total_qty);
            }
            else{
               $('.cart-badge').hide();
            }
            setTimeout(() => {
       modal.classList.add('slideout');
    }, 1500);
    setTimeout(() => {
       modal.classList.remove('slideout');
       $('#danger').hide();
    }, 2000);
           }
        })
   }

   // <img style="position: relative;top:-6px;" width="50px" height="37.59px" src="{{asset('images/spinn.gif')}}" alt="">

       $(document).ready(function () {
       //    function store(val) {

       //      alert(val)
       //    }
       })
   </script>

<script>
   let img_1 = document.querySelector('#img-1');
   let img_2 = document.querySelector('#img-2');
   let img_3 = document.querySelector('#img-3');
   let main_img = document.querySelector('#main-img');

   img_1.addEventListener('click',function() {
     main_img.src = img_1.src;
     img_1.style.opacity = 1;
     img_2.style.opacity = 0.5;
     img_3.style.opacity = 0.5;
   })
   img_2.addEventListener('click',function() {
     main_img.src = img_2.src;
     img_1.style.opacity = 0.5;
     img_2.style.opacity = 1;
     img_3.style.opacity = 0.5;
   })
   img_3.addEventListener('click',function() {
     main_img.src = img_3.src;
     img_1.style.opacity = 0.5;
     img_2.style.opacity = 0.5;
     img_3.style.opacity = 1;
   })
</script>


<script>

    let summary = document.querySelector('.summary');
    let swiper = document.querySelector('.box').getBoundingClientRect();
    let space =  document.querySelector('.space');
    let bottom = summary.getBoundingClientRect().bottom;
    let bottom2 = swiper.bottom;
    let checkout = document.querySelector('.checkout-card');
    let screenHeight = screen.height;
    let boxBottom = swiper.bottom+110;

    if (boxBottom>screenHeight) {
     checkout.classList.add('checkout-fixed')
    }
    else{
        checkout.classList.add('checkout-abs')
    }
    function scroll() {

       if (screen.width<=991) {
          if(document.documentElement.scrollTop>=boxBottom-screenHeight){
            checkout.classList.remove('checkout-fixed')
            checkout.classList.add('checkout-abs')
          }
          else{
            checkout.classList.remove('checkout-abs')
            checkout.classList.add('checkout-fixed')
          }
       }

     if (document.documentElement.scrollTop>=bottom2-bottom){
    summary.classList.remove('fixed');
     summary.classList.add('abs');
    }
    else{
     summary.classList.remove('abs');
     summary.classList.add('fixed');
     }
    }
    window.onscroll = function () {
  scroll();
};

 </script>

<script>
    let recentBox = document.querySelectorAll('.recentbox');
    let recent = document.querySelector('.recent');
    let leftBtn_ = document.querySelector('#recentleftBtn')
    let rightBtn_ = document.querySelector('#recentrightBtn')
    let rightTurn_ = 0;
    let leftTurn_ = 0;


    let pressed_ = false;
    let startx_;
    let x_;
    let position_ = 0;
    const positionArray_ = [];
    let movements_=[]


    document.querySelector('.recent-cont').addEventListener('mouseenter',function () {
        leftbtnBoundary_()
        rightbtnBoundary_()
    })

    document.querySelector('.recent-cont').addEventListener('mouseleave',function () {
        rightBtn_.style.display = 'none';
        leftBtn_.style.display = 'none';
    })


    // SETS INITIAL POSITION FOR THE BOXES
    recentBox.forEach((val,i)=>{
        val.style.left += `${position_}px`;
        positionArray_[i] = position_;
        position_ += 210;
    })


    if (screen.width>=1000) {
        recentBox.forEach((val,i)=>{
        val.style.transition += '0.5s ease-out';
    })
    }

    leftBtn_.addEventListener('click',function() {
    if (parseInt(recentBox[0].style.left)<0) {
        rightTurn_ -= 4
       let value_ = movements_.shift();
        recentBox.forEach((val,index)=>{
        val.style.left = `${positionArray_[index]+(210*value_)}px`;
      })
      recentBox.forEach((val,index)=>{
        positionArray_[index] = parseInt(val.style.left);
      })
    }

    leftbtnBoundary_()
    rightbtnBoundary_()
    })



    rightBtn_.addEventListener('click',function() {
    rightTurn_ += 4;
    if (rightTurn_<recentBox.length) {
      if (!(recentBox.length-rightTurn_<4)) {
        recentBox.forEach((val,index)=>{
        val.style.left = `${positionArray_[index]-210*4}px`;
      })
      movements_.push(4);
      recentBox.forEach((val,index)=>{
        positionArray_[index] = parseInt(val.style.left);
      })
      }
      else{
        recentBox.forEach((val,index)=>{
        val.style.left = `${positionArray_[index]-210*(recentBox.length-rightTurn_)}px`;
      })
      recentBox.forEach((val,index)=>{
        positionArray_[index] = parseInt(val.style.left);
      })
      movements_.push(recentBox.length-rightTurn_);
      }
    }
    else{
        rightTurn_ -= 4;
    }

    leftbtnBoundary_()
    rightbtnBoundary_()
    })

    // EVENT LISTENER FOR TOUCHSTART, INITIALIZES START POSITION
    recentBox.forEach((val,i) => {
        recentBox[i].addEventListener('touchstart',function(e) {
    startx_ = e.touches[0].clientX;
    })
    });


    // EVENT LISTENER FOR TOUCHMOVE
    recentBox.forEach((val,i) => {
        recentBox[i].addEventListener('touchmove',function(e){
       if (recentBox.length>=3&&screen.width<=630) {
        var touch_ = e.touches[0];

    var change_ = touch_.clientX - startx_;

    // CHECKS IF THE SWIPE DIRECTION IS FORWARD
    if(change_<0){
     for (let i = 0; i < recentBox.length; i++) {
    recentBox[i].style.left = `${positionArray_[i]+change_}px`;
    }
    rightBoundary_();
    }

    // CHECKS IF THE SWIPE DIRECTION IS BACKWARD
    else{
    for (let i = 0; i < recentBox.length; i++) {
    recentBox[i].style.left = `${change_+positionArray_[i]}px`;
    }

    leftBoundary_();
    }

    e.preventDefault();
       }
       else if (recentBox.length>=5&&screen.width<=1024) {
        var touch_ = e.touches[0];

    var change_ = touch_.clientX - startx_;

    // CHECKS IF THE SWIPE DIRECTION IS FORWARD
    if(change_<0){
     for (let i = 0; i < recentBox.length; i++) {
    recentBox[i].style.left = `${positionArray_[i]+change_}px`;
    }
    rightBoundary_();
    }

    // CHECKS IF THE SWIPE DIRECTION IS BACKWARD
    else{
    for (let i = 0; i < recentBox.length; i++) {
    recentBox[i].style.left = `${change_+positionArray_[i]}px`;
    }

    leftBoundary_();
    }

    e.preventDefault();
       }
    })


    });


    // EVENT LISTENER FOR TOUCHEND
    recentBox.forEach((val,i) => {
        recentBox[i].addEventListener('touchend',function(e){
        var change_ = startx_ - e.changedTouches[0].clientX

    // CHECKS IF THE SWIPE DIRECTION IS FORWARD
       if (change_>0) {

    // CHECKS IF THE BOX HAS BEEN SWIPED HALFWAY OUT OF THE SCREEN AND IF ITS NOT THE LAST ELEMENT
           if (change_>210/2) {
           for (let i = 0; i < positionArray_.length; i++) {
                positionArray_[i] = parseInt(recentBox[i].style.left);
            }
           }
           // ELSE ROLLBACK TO PREV POSITION
           else{
            for (let i = 0; i < cardBox.length; i++) {
                recentBox[i].style.left = `${positionArray_[i]}px`;
            }
           }

       }

    // CHECKS IF THE SWIPE DIRECTION IS BACKWARD
       else{
        if (-change_>210/2) {
           for (let i = 0; i < positionArray_.length; i++) {
                positionArray_[i] = parseInt(recentBox[i].style.left);
            }
           }

    // ELSE ROLLBACK TO PREV POSITION
         else{
            for (let i = 0; i < cardBox.length; i++) {
                recentBox[i].style.left = `${positionArray_[i]}px`;
            }
         }
       }


    e.preventDefault();

    })


    });

    function rightbtnBoundary_() {
    if (parseInt(recentBox[recentBox.length-1].style.left)<=630) {
      rightBtn_.style.display = 'none';
    }
    else{
        rightBtn_.style.display = 'block';
    }
    }

    function leftbtnBoundary_() {
    if (parseInt(recentBox[0].style.left)>=0) {
        leftBtn_.style.display = 'none';
    }
    else{
        leftBtn_.style.display = 'block';
    }
    }

    function rightBoundary_() {
    if (recentBox[recentBox.length-1].getBoundingClientRect().right<recent.getBoundingClientRect().right) {
       let width_ = recent.getBoundingClientRect().width - recentBox[recentBox.length-1].getBoundingClientRect().width - 20;
        for (let k = recentBox.length-1; k >= 0; k--) {
            recentBox[k].style.left = `${width_}px`;
            width_ -= 210;
        }
        recentBox[recentBox.length-1].style.left = `${recent.getBoundingClientRect().width - recentBox[recentBox.length-1].getBoundingClientRect().width - 20}px`
    }
    }

    function leftBoundary_() {
    if (parseInt(recentBox[0].style.left)>0) {
       let width_ = 0;
        for (let k = 0; k < recentBox.length; k++) {
            recentBox[k].style.left = `${width_}px`;
            width_ += 210;
        }
    }
    }
    </script>



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

