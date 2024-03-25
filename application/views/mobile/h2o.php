<div class="contents_01 contents_layer h2o_in">
	<img src="/images/mobile/h2o/h2o_1.png" alt="">
</div>
<div class="contents_02 contents_layer h2o_in gift2">
	<div class="gift_count">
		<p class="h2o-text1">진행된 H2O 횟수: <strong class="h2o_blue"><span class="nums" data-count="14">0</span>회차</strong></p>
		<p class="h2o-text2">총 기부금액</p>
		<p class="h2o-text3"><strong class="h2o_blue"><span class="nums" data-count="140">0</span>,000,000 원</strong></p>
        <div class="wing"><img src="/images/h2o/wing.png" alt=""></div>
	</div>
	<img src="/images/mobile/h2o/h2o_2.png" alt="">
</div>
<div class="contents_03 contents_layer h2o_in">
	<img src="/images/mobile/h2o/h2o_3.png" alt="">
</div>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.min.js"></script>
    <script>
        //숫자 카운트 애니메이션
        $('.nums').each(function () {
            const $this = $(this),
                countTo = $this.attr('data-count');

            $({
                countNum: $this.text()
            }).animate({
                countNum: countTo
            }, {
                duration: 3000,
                easing: 'linear',
                step: function () {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function () {
                    $this.text(this.countNum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
                    //3자리 마다 콤마 표시 적용
                }
            });
        });
    </script>

