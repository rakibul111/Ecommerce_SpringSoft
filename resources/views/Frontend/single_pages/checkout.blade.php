@extends('Frontend.layouts.master')
@section('content')
            <div class="breadcrumb-area bg-gray">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <ul>
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="active">Checkout </li>
                    </ul>
                </div>

                @php
                $contents=Cart::content();
            @endphp

{{-- orderslide --}}
<div  class="container overflow-hidden">
    <div class="multisteps-form  ">
      <div class="row">
        <div class="col-8 col-lg-8 mb-4 ml-auto mr-auto">
          <div class="multisteps-form__progress">
            <button style="color:#6F50A7" class="multisteps-form__progress-btn js-active" type="button" title="User Info">Address</button>
            <button style="color:#6F50A7" class="multisteps-form__progress-btn" type="button" title="Address">Order Info</button>
            <button style="color:#6F50A7" class="multisteps-form__progress-btn" type="button" title="Order Info">Payment</button>
            
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-8 col-lg-8 mb-4 ml-auto mr-auto">
          <form class="multisteps-form__form ">
            <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
              <h3 style="color:#6F50A7" class="multisteps-form__title"><i class="fas fa-user"></i> Personal Information</h3><hr>
              <div class="multisteps-form__content">
                <div class="form-row mt-4">
                  <div class="col-12 col-sm-6">
                    <input class="multisteps-form__input form-control" required  type="text" placeholder="First Name" value="{{ @$users->name }}" required/>
                  </div>
                  <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                    <input required class="multisteps-form__input form-control" type="text" placeholder="Last Name"/>
                  </div>
                </div>
                <div class="form-row mt-4">
                  <div class="col-12 col-sm-6">
                    <input class="multisteps-form__input form-control" type="text" placeholder="Email" value="{{ @$users->email }}" required/>
                  </div>
                  <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                    <input class="multisteps-form__input form-control" type="email" placeholder="Contact"  required/>
                  </div><br><br><br>
                  <h3 style="color:#6F50A7" > <i class="fas fa-shipping-fast"></i> Shipping Details</h3> <hr>
                </div>
                <div class="form-row mt-4">
                  <div class="col-12 col-sm-6">
                    <input class="multisteps-form__input form-control" type="address" placeholder="address" required/>
                  </div><br>
                  <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                    <input class="multisteps-form__input form-control" type="email" placeholder="email" required/><br>
                  </div><br>
                  <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                    <input class="multisteps-form__input form-control" type="Country" placeholder="country" required/>
                  </div>
                  <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                    <input class="multisteps-form__input form-control" type="City" placeholder="city" required/><br>
                  </div>
                  <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                    <input class="multisteps-form__input form-control" type="Postal Code" placeholder="Postal Code" required/>
                  </div>
                </div>
                <div class="button-row d-flex mt-4">
                  <button style="background-color:#FF2F2F; color:white;" class="btn ml-auto js-btn-next" type="submit" title="Next">Next</button>
                </div>
              </div>
            </div>

            <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
              <h3 style="color:#6F50A7" class="multisteps-form__title">Your order</h3>
              <div class="multisteps-form__content">
            
                    <div class="your-order-area">
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-info-wrap">
                                <div class="your-order-info">
                                    <ul>
                                        <li>Product <span>Total</span></li>
                                    </ul>
                                </div>
                                @if (Auth::user())
                                <div class="your-order-middle">

                                    @foreach ($showCart as $show)
                                    @if ($show['product']['promo_price'])
                                    <li> Product :{{ $show['product']['name'] }} <span> ({{ $show->qty }}x{{ $show['product']['promo_price'] }} )</span></li>
                                    @else
                                    <li> Product :{{ $show['product']['name'] }} <span> ({{ $show->qty }}x{{ $show['product']['price'] }} )</span></li>
                                    @endif


                                    @endforeach
                                </div>
                                @php
                                $subammount=0;
                                    foreach ($showCart as $show) {
                                        if($show->product->promo_price){
                                            $subtotal = $show->product->promo_price * $show->qty;
                                        }
                                        else  
                                            $subtotal = $show->product->price * $show->qty;
                                        $subammount+=$subtotal;
                                    }
                                @endphp
                                <div class="your-order-info order-subtotal">
                                    <ul>
                                        <li>Subtotal <span> {{ $subammount }} tk</span></li>
                                    </ul>
                                </div>

                                <div class="your-order-info order-total">

                                    @if (Session::has('cartcupon-'.auth()->id()))
                                    <ul>
                                        <li>Total <span>{{ ($subammount +20)- Session::get('cartcupon-'.auth()->id())[0]}} tk </span></li>
                                    </ul>
                                    @else
                                    <ul>
                                        <li>Total <span>{{ $subammount +20}} tk </span></li>
                                    </ul>
                                    @endif

                                </div>
                                @else
                                <div class="your-order-middle">
                                    @foreach ($contents as $content)
                                        <li> Product :{{ $content->name }} <span> ({{ $content->qty }}x{{ $content->price }} )</span></li>
                                    @endforeach
                                    <div class="your-order-info order-subtotal">
                                         <ul>
                                            <li>Subtotal <span> {{ Cart::subtotal() }} tk</span></li>
                                        </ul>
                                    </div>

                                    <div class="your-order-info order-total">
                                        <ul>
                                            {{--  @php
                                                (float)$sum=Cart::subtotal();
                                            @endphp  --}}

                                            <li>Total <span>{{ Cart::subtotal() }} tk </span></li>
                                        </ul>
                                    </div>

                                </div>
                                @endif


                            </div>
                    
                </div>
                        
                 
            
                </div>
                <div class="button-row d-flex mt-4">
                  <button style="background-color:#FF2F2F; color:white;" class="btn  js-btn-prev" type="button" title="Prev">Prev</button>
                  <button style="background-color:#FF2F2F; color:white;" class="btn  ml-auto js-btn-next" type="button" title="Next">Next</button>
                </div>
              </div>
            </div>

            <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
              <h3 style="color:#6F50A7" class="multisteps-form__title">Confirm receiver</h3><hr>
              <div>
                <p><i style="color:#6F50A7" class="fas fa-user"></i> lincon</p>
                <p><i style="color:#6F50A7" class="fas fa-map-marker-alt"></i> dhaka</p>
                <p><i style="color:#6F50A7" class="fas fa-phone"></i> 01784545453</p>
                <p><i style="color:#6F50A7"class="fas fa-envelope"></i> reza@gmail.com</p>
              </div> <br>
              <h3 style="color:#6F50A7">Payment Info</h3> <hr>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                 Cash on delivery
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                  Online Payment
                </label>
              </div>
              <div class="button-row d-flex mt-4">
                <button style="background-color:#FF2F2F; color:white;" class="btn  js-btn-prev" type="button" title="Prev">Prev</button>
                <button style="background-color:#FF2F2F; color:white;" class="btn  ml-auto js-btn-next" type="button" title="send">Next</button>
              </div>                
            </div>

            <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
              <h3 style="color:#6F50A7" class="multisteps-form__title">Additional Message</h3>
              <div class="multisteps-form__content">
                <div class="form-row mt-4">
                  <textarea class="multisteps-form__textarea form-control" placeholder="Additional Message and Questions"></textarea>
                </div>
                <div class="button-row d-flex mt-4">
                  <button style="background-color:#FF2F2F; color:white;" class="btn  js-btn-prev" type="button" title="Prev">Prev</button>
                  <button style="background-color:#FF2F2F; color:white;" class="btn  ml-auto" type="submit" title="Send">Confirm Order</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
const DOMstrings = {
  stepsBtnClass: 'multisteps-form__progress-btn',
  stepsBtns: document.querySelectorAll(`.multisteps-form__progress-btn`),
  stepsBar: document.querySelector('.multisteps-form__progress'),
  stepsForm: document.querySelector('.multisteps-form__form'),
  stepsFormTextareas: document.querySelectorAll('.multisteps-form__textarea'),
  stepFormPanelClass: 'multisteps-form__panel',
  stepFormPanels: document.querySelectorAll('.multisteps-form__panel'),
  stepPrevBtnClass: 'js-btn-prev',
  stepNextBtnClass: 'js-btn-next' };


const removeClasses = (elemSet, className) => {

  elemSet.forEach(elem => {

    elem.classList.remove(className);

  });

};

const findParent = (elem, parentClass) => {

  let currentNode = elem;

  while (!currentNode.classList.contains(parentClass)) {
    currentNode = currentNode.parentNode;
  }

  return currentNode;

};

const getActiveStep = elem => {
  return Array.from(DOMstrings.stepsBtns).indexOf(elem);
};

const setActiveStep = activeStepNum => {

  removeClasses(DOMstrings.stepsBtns, 'js-active');

  DOMstrings.stepsBtns.forEach((elem, index) => {

    if (index <= activeStepNum) {
      elem.classList.add('js-active');
    }

  });
};

const getActivePanel = () => {

  let activePanel;

  DOMstrings.stepFormPanels.forEach(elem => {

    if (elem.classList.contains('js-active')) {

      activePanel = elem;

    }

  });

  return activePanel;

};

const setActivePanel = activePanelNum => {

  removeClasses(DOMstrings.stepFormPanels, 'js-active');

  DOMstrings.stepFormPanels.forEach((elem, index) => {
    if (index === activePanelNum) {

      elem.classList.add('js-active');

      setFormHeight(elem);

    }
  });

};

const formHeight = activePanel => {

  const activePanelHeight = activePanel.offsetHeight;

  DOMstrings.stepsForm.style.height = `${activePanelHeight}px`;

};

const setFormHeight = () => {
  const activePanel = getActivePanel();

  formHeight(activePanel);
};

DOMstrings.stepsBar.addEventListener('click', e => {

  const eventTarget = e.target;

  if (!eventTarget.classList.contains(`${DOMstrings.stepsBtnClass}`)) {
    return;
  }

  const activeStep = getActiveStep(eventTarget);

  setActiveStep(activeStep);

  setActivePanel(activeStep);
});

DOMstrings.stepsForm.addEventListener('click', e => {

  const eventTarget = e.target;

  if (!(eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`) || eventTarget.classList.contains(`${DOMstrings.stepNextBtnClass}`)))
  {
    return;
  }

  const activePanel = findParent(eventTarget, `${DOMstrings.stepFormPanelClass}`);

  let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);

  if (eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`)) {
    activePanelNum--;

  } else {

    activePanelNum++;

  }

  setActiveStep(activePanelNum);
  setActivePanel(activePanelNum);

});

window.addEventListener('load', setFormHeight, false);

window.addEventListener('resize', setFormHeight, false);


const setAnimationType = newType => {
  DOMstrings.stepFormPanels.forEach(elem => {
    elem.dataset.animation = newType;
  });
};

//changing animation
const animationSelect = document.querySelector('.pick-animation__select');

animationSelect.addEventListener('change', () => {
  const newAnimationType = animationSelect.value;

  setAnimationType(newAnimationType);
});

</script>

@endsection
