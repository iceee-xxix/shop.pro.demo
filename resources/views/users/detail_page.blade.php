@extends('layouts.luxury-nav')

@section('title', 'เมนู')

@section('content')
    <?php
    
    use App\Models\Config;
    
    $config = Config::first();
    ?>
    <style>
        .title-food {
            font-size: 30px;
            font-weight: bold;
            color: <?=$config->color_font !='' ? $config->color_font : '#ffffff' ?>;
        }

        .card-food {
            background-color: var(--bg-card-food);
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
            padding: 4px;
        }


        .card-title {
            font-size: 15px;
        }

        .btn-gray-left {
            background-color: #d3d3d3;
            color: #333;
            border: none;
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
            padding: 0px 14px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .btn-gray-right {
            background-color: #d3d3d3;
            color: #333;
            border: none;
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
            padding: 0px 14px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .btn-gray-left:hover {
            background-color: #c0c0c0;
            transform: scale(1.05);
        }

        .btn-gray-right:hover {
            background-color: #c0c0c0;
            transform: scale(1.05);
        }

        .count {
            background-color: #e0e0e0;
            padding: 1.5px 0px;
        }

        .custom-height-offcanvas {
            height: 95vh !important;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            overflow-y: auto;
            padding: 0;
        }

        .img-cover-wrapper {
            position: relative;
        }

        .btn-close-top-left {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: white;
            border-radius: 50%;
            padding: 0.5rem 0.5rem;
            z-index: 10;

        }

        .text-alret-blue {
            background-color: #d9fcff;
        }

        .text-alret-gray {
            background-color: #f3f3f3;
        }

        .btn-plus {
            background-color: #82f3fd;
            color: #ffff;
            border-radius: 50%;
            border: 0px solid #333;
            font-size: 20px;
            padding: 0px 8px;
        }

        .btn-minus {
            background-color: #b2f9ff;
            color: #ffff;
            border-radius: 50%;
            border: 0px solid #333;
            font-size: 20px;
            padding: 0px 8px;
        }

        .cart-amount-badge {
            position: absolute;
            bottom: 5px;
            right: 20px;
            transform: translateX(50%);
            border:1px solid #30acff;
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            padding: 2px 10px;
            font-size: 13px;
            border-radius: 50%;
            z-index: 10;
        }
    </style>
    @php
        $menu = [
            [
                'id' => 1,
                'name' => 'ข้าวผัดกะเพรา',
                'base_price' => 45,
                'files' => null,
                'option' => [
                    'พิเศษ' => [
                        'is_selected' => 1,
                        'amout' => 2,
                        'items' => [
                            (object) ['id' => 1, 'type' => 'เพิ่มชีส', 'price' => 10],
                            (object) ['id' => 2, 'type' => 'เพิ่มไข่', 'price' => 5],
                        ],
                    ],
                    'เพิ่มเติม' => [
                        'is_selected' => 0,
                        'amout' => 0,
                        'items' => [
                            (object) ['id' => 3, 'type' => 'ซอสพริก', 'price' => 2],
                            (object) ['id' => 4, 'type' => 'ซอสมะเขือเทศ', 'price' => 4],
                        ],
                    ],
                ],
            ],
            [
                'id' => 2,
                'name' => 'ข้าวมันไก่',
                'base_price' => 35,
                'files' => null,
                'option' => [
                    'พิเศษ' => [
                        'is_selected' => 1,
                        'amout' => 1,
                        'items' => [
                            (object) ['id' => 5, 'type' => 'เพิ่มกุนเชียง', 'price' => 10],
                            (object) ['id' => 6, 'type' => 'เพิ่มไข่ดาว', 'price' => 5],
                        ],
                    ],
                    'เพิ่มเติม' => [
                        'is_selected' => 0,
                        'amout' => 0,
                        'items' => [
                            (object) ['id' => 7, 'type' => 'แจ๋ว', 'price' => 0],
                            (object) ['id' => 8, 'type' => 'ซอสมะเขือ', 'price' => 0],
                        ],
                    ],
                ],
            ],
        ];
    @endphp
    <div class="container">
        <div class="d-flex flex-column justify-content-center gap-2">
            <div class="title-food">
                หมวดอาหาร
            </div>
            <div class="row justify-content-center gap-3">
                @foreach ($menu as $rs)
                    <!-- Card -->
                    <div class="col-5 g-0" style="cursor: pointer; border-radius: 10px;" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasBottom-{{ $rs['id'] }}">
                        <div class="row g-0 flex-column">
                            <div class="col">
                                <div class="position-relative">
                                    @if ($rs['files'])
                                        <img src="{{ url('storage/' . $rs['files']->file) }}" class="img-fluid rounded"
                                            style="width: 100%; height: 130px; object-fit: cover; border-radius: 10px;"
                                            alt="food">
                                    @else
                                        <img src="{{ asset('foods/default-photo.png') }}" class="img-fluid rounded"
                                            style="width: 100%; height: 130px; object-fit: cover; border-radius: 10px;"
                                            alt="food">
                                    @endif

                                    <!-- 🔢 Badge แสดงจำนวน (ซ่อนไว้ก่อน) -->
                                    <span class="cart-amount-badge d-none" data-badge-name="{{ $rs['name'] }}">0</span>

                                </div>
                            </div>
                            <div class="col">
                                <div class="p-0 pt-2 text-start" style="background-color: transparent;">
                                    <h5 class="m-0 card-title">{{ $rs['name'] }}</h5>
                                    <p class="fw-bold card-title mb-0">{{ $rs['base_price'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Offcanvas -->
                    <div class="offcanvas offcanvas-bottom custom-height-offcanvas" tabindex="-1"
                        id="offcanvasBottom-{{ $rs['id'] }}" aria-labelledby="offcanvasBottomLabel">

                        <div class="img-cover-wrapper">
                            <button type="button" class="btn-close btn-close-top-left" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>

                            @if ($rs['files'])
                                <img src="{{ url('storage/' . $rs['files']->file) }}" class="img-cover"
                                    style="width: 100%; height: 200px; object-fit: cover;" alt="food">
                            @else
                                <img src="{{ asset('foods/default-photo.png') }}" class="img-cover"
                                    style="width: 100%; height: 200px; object-fit: cover;" alt="food">
                            @endif
                        </div>

                        <div class="offcanvas-body small px-3">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="offcanvas-title fw-bold mb-0 fs-5  product-name">{{ $rs['name'] }}</h5>
                                <span class="text-end fs-5 fw-bold" style="line-height: 1.0;">
                                    {{ $rs['base_price'] }} <br>
                                    <span class="text-muted"
                                        style="font-size: 14px; font-weight: normal;">ราคาเริ่มต้น</span>
                                </span>
                            </div>
                            <hr>
                            @foreach ($rs['option'] as $category => $optionGroup)
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <h6 class="fs-6 fw-bold mb-0">{{ $category }}</h6>
                                    <small
                                        class="text-muted px-2  rounded-5 {{ $optionGroup['is_selected'] == 1 ? 'text-alret-blue' : 'text-alret-gray' }}">
                                        @if ($optionGroup['is_selected'] == 1)
                                            เลือก {{ $optionGroup['amout'] }}
                                        @else
                                            ไม่จำเป็นต้องระบุ
                                        @endif
                                    </small>
                                </div>

                                @foreach ($optionGroup['items'] as $option)
                                    <div class="d-flex justify-content-between align-items-center py-0">
                                        <div
                                            class="form-check d-flex justify-content-between align-items-center w-100 mb-0 py-0">
                                            <div>
                                                <input class="form-check-input me-2 option-checkbox" type="checkbox"
                                                    data-limit="{{ $optionGroup['amout'] }}"
                                                    data-required="{{ $optionGroup['is_selected'] }}"
                                                    data-group="group_{{ $rs['id'] }}_{{ $category }}""
                                                    data-rs-id="{{ $rs['id'] }}"
                                                    data-category="{{ Str::slug($category, '_') }}"
                                                    data-type="{{ $category }}" data-price="{{ $option->price }}"
                                                    id="option_{{ $option->id }}"
                                                    @if ($loop->first) data-base-price="{{ $rs['base_price'] }}" @endif
                                                    name="option_{{ $rs['id'] }}_{{ Str::slug($category, '_') }}[]"
                                                    value="{{ $option->id }}">
                                                <label class="form-check-label" for="option_{{ $option->id }}">
                                                    {{ $option->type }}
                                                </label>
                                            </div>
                                            <div class="d-flex justify-content-end align-items-center"
                                                style="min-width: 60px;">
                                                <i class="fa-solid fa-plus" style="font-size: 9px; margin-right: 1px;"></i>
                                                <span>{{ $option->price }}</span>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                                <hr>
                            @endforeach
                            <div class="mt-3 text-start ">
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <label for="note_{{ $rs['id'] }}"
                                        class="form-label fw-bold fs-6">หมายเหตุถึงร้านอาหาร</label>
                                    <small class="text-muted px-2  rounded-5 text-alret-gray">
                                        ไม่จำเป็นต้องระบุ
                                    </small>
                                </div>
                                <textarea id="note_{{ $rs['id'] }}" name="note_{{ $rs['id'] }}" class="form-control" rows="3"
                                    placeholder="ระบุรายละเอียดคำขอ (ขึ้นอยู่กับดุลยพินิจของร้าน)"></textarea>
                            </div>
                            <div class="d-flex justify-content-center align-items-center gap-2 mt-3 "
                                style="margin-bottom: 4rem;">
                                <button type="button" class="btn-minus" data-id="{{ $rs['id'] }}"><i
                                        class="fa-solid fa-minus"></i></button>
                                <div class="note-count fw-bold fs-5" data-id="{{ $rs['id'] }}"
                                    style="min-width: 30px; text-align: center;">0</div>
                                <button type="button" class="btn-plus" data-id="{{ $rs['id'] }}"><i
                                        class="fa-solid fa-plus"></i></button>
                            </div>
                            <div class="fixed-bottom py-3"
                                style="background-color: white; z-index: 999; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5); border: none;">
                                <div class="container text-center">
                                    <button id="add-to-cart-btn" class=" add-to-cart-btn btn btn-primary w-100 "
                                        style="font-size: 16px; border-radius: 25px;" data-rs-id="{{ $rs['id'] }}"
                                        disabled>
                                        เพิ่มไปยังตะกร้า - <span id="total-price">{{ $rs['base_price'] }}</span> ฿
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button id="clear-cart" class="btn btn-danger">ล้างตะกร้าสินค้า</button>

            <script>
                document.getElementById('clear-cart').addEventListener('click', function() {
                    localStorage.removeItem('cart');
                    console.log('🧹 ล้างข้อมูลตะกร้าเรียบร้อยแล้ว');
                });
            </script>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateAmountBadgesFromCart() {
                const cart = JSON.parse(localStorage.getItem('cart')) || [];

                document.querySelectorAll('[data-badge-name]').forEach(badge => {
                    const name = badge.dataset.badgeName;
                    const foundItem = cart.find(item => item.name === name);

                    if (foundItem && foundItem.amount > 0) {
                        badge.textContent = foundItem.amount;
                        badge.classList.remove('d-none');
                    } else {
                        badge.classList.add('d-none');
                    }
                });
            }

            // 🔁 เรียกใช้ตอนโหลดหน้า
            updateAmountBadgesFromCart();

            // 🔁 เรียกใหม่ทุกครั้งที่เพิ่มของลงตะกร้า
            const originalSetItem = localStorage.setItem;
            localStorage.setItem = function(key, value) {
                originalSetItem.apply(this, arguments);
                if (key === 'cart') updateAmountBadgesFromCart();
            };
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.option-checkbox');

            function handleCheckboxChange(event) {
                const cb = event.target;
                // ข้อมูลจาก data-attribute
                const rsId = cb.dataset.rsId;
                const group = cb.dataset.group;
                const limit = parseInt(cb.dataset.limit);
                const required = parseInt(cb.dataset.required);
                const price = parseFloat(cb.dataset.price) || 0;

                // เลือก checkbox ทั้งหมดในกลุ่มเดียวกัน
                const groupCheckboxes = Array.from(document.querySelectorAll(
                    `.option-checkbox[data-rs-id="${rsId}"][data-group="${group}"]`
                ));

                const checked = groupCheckboxes.filter(cb => cb.checked);

                // ✅ กรณี checkbox กลุ่มนี้บังคับเลือก
                if (required === 1) {
                    groupCheckboxes.forEach(item => {
                        item.disabled = !item.checked && checked.length >= limit;
                    });
                }

                // ✅ ไม่ต้องปิด checkbox ถ้าไม่บังคับ
                if (required) {
                    groupCheckboxes.forEach(item => {
                        item.disabled = false;
                    });
                }

                // ✅ เริ่มต้นราคาด้วย base_price
                const basePriceElement = document.querySelector(`.option-checkbox[data-rs-id="${rsId}"]`);
                let totalPrice = parseFloat(basePriceElement?.dataset.basePrice || 0);

                // ✅ รวมราคาจาก options ที่เลือก
                const rsCheckboxes = Array.from(document.querySelectorAll(
                    `.option-checkbox[data-rs-id="${rsId}"]`));
                rsCheckboxes.forEach(cb => {
                    if (cb.checked) {
                        totalPrice += parseFloat(cb.dataset.price) || 0;
                    }
                });

                const priceLabel = document.querySelector(`#offcanvasBottom-${rsId} #total-price`);
                if (priceLabel) {
                    priceLabel.textContent = totalPrice.toFixed(2);
                }

                // ✅ ตรวจสอบว่าเลือกครบทุก group ที่บังคับในเมนูนี้หรือไม่
                const groups = [...new Set(rsCheckboxes.map(cb => cb.dataset.group))];
                let allRequiredGroupsValid = true;

                groups.forEach(groupKey => {
                    const groupCBs = rsCheckboxes.filter(cb => cb.dataset.group === groupKey);
                    const groupRequired = parseInt(groupCBs[0]?.dataset.required || 0);
                    const groupLimit = parseInt(groupCBs[0]?.dataset.limit || 0);
                    const checkedCount = groupCBs.filter(cb => cb.checked).length;

                    if (groupRequired === 1 && checkedCount !== groupLimit) {
                        allRequiredGroupsValid = false;
                    }
                });

                const addToCartBtn = document.querySelector(`#offcanvasBottom-${rsId} #add-to-cart-btn`);
                if (addToCartBtn) {
                    addToCartBtn.disabled = !allRequiredGroupsValid;
                }
            }

            // ✅ ใช้ event handler เฉพาะตอน checkbox เปลี่ยน
            checkboxes.forEach(cb => cb.addEventListener('change', handleCheckboxChange));
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ✅ ฟังก์ชันเพิ่ม/ลดจำนวน
            function changeNoteQty(rsId, delta) {
                const noteCountDiv = document.querySelector(`.note-count[data-id="${rsId}"]`);
                if (!noteCountDiv) return;
                let currentCount = parseInt(noteCountDiv.textContent) || 0;
                currentCount += delta;
                if (currentCount < 0) currentCount = 0;
                noteCountDiv.textContent = currentCount;
            }

            // ✅ ผูก event ปุ่ม + และ -
            document.querySelectorAll('.btn-minus').forEach(btn => {
                btn.addEventListener('click', function() {
                    const rsId = this.dataset.id;
                    changeNoteQty(rsId, -1);
                });
            });

            document.querySelectorAll('.btn-plus').forEach(btn => {
                btn.addEventListener('click', function() {
                    const rsId = this.dataset.id;
                    changeNoteQty(rsId, 1);
                });
            });

            // ✅ ผูก event กับปุ่ม add-to-cart แต่ละปุ่ม
            const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

            addToCartButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const rsId = this.dataset.rsId;
                    const offcanvasEl = this.closest('.offcanvas');

                    // คำนวณราคา
                    const basePriceEl = offcanvasEl.querySelector(
                        '.option-checkbox[data-base-price]');
                    const basePrice = parseFloat(basePriceEl?.dataset.basePrice || 0);

                    const noteTextarea = document.getElementById(`note_${rsId}`);
                    const noteText = noteTextarea ? noteTextarea.value : '';

                    const noteCountDiv = document.querySelector(`.note-count[data-id="${rsId}"]`);
                    const amount = noteCountDiv ? parseInt(noteCountDiv.textContent) || 0 : 0;

                    const allCheckboxes = offcanvasEl.querySelectorAll('.option-checkbox');
                    const selectedOptions = [];
                    let totalOptionPrice = 0;

                    allCheckboxes.forEach(cb => {
                        if (cb.checked) {
                            const option = {
                                id: cb.value || cb.dataset.optionId || null,
                                type: cb.dataset.label || cb.dataset.type ||
                                    'ไม่ทราบชื่อ',
                                price: parseFloat(cb.dataset.price || 0),
                            };
                            totalOptionPrice += option.price;
                            selectedOptions.push(option);
                        }
                    });

                    const totalPrice = basePrice + totalOptionPrice;

                    const product = {
                        id: rsId,
                        name: offcanvasEl.querySelector('.product-name')?.textContent ||
                            'ไม่ทราบชื่อเมนู',
                        base_price: basePrice,
                        total_price: (totalPrice || 0) * (amount || 1),
                        options: selectedOptions,
                        note: noteText,
                        amount: amount,
                    };

                    let cart = JSON.parse(localStorage.getItem('cart')) || [];
                    cart.push(product);
                    localStorage.setItem('cart', JSON.stringify(cart));
                    console.log("🛒 ตะกร้าสินค้าใน localStorage:", cart);

                    // ✅ ปิด Offcanvas
                    const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                    if (bsOffcanvas) {
                        bsOffcanvas.hide();
                    }
                });
            });
        });
    </script>



@endsection
