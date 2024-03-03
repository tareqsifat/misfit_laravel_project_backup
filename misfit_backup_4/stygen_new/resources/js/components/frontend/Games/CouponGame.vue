<template>
		<section class="vue-winwheel">
			<div class="mobile-container">
				<p class="main-text mb-3">Try your luck, get up to 20% coupon</p>
				<div class="wheel-wrapper">
					<div class="canvas-wrapper">
						<canvas id="canvas" width="310" height="310">
							<p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try Google Chrome.</p>
						</canvas>
					</div>
					<div class="button-wrapper">
						<!-- <router-link :to="{name: 'register'}" >Register to play the game</router-link>   -->
                        <router-link to="/login" class="btn btn-play">Register/login to play the game</router-link>
                        <!-- href="#" @click.prevent="startSpin()" v-if="!loadingPrize && !wheelSpinning"></a> -->
					</div>
				</div>
			</div>
			<div class="custom-modal modal-mask" id="modalSpinwheel" v-if="modalPrize">
				<div slot="body">
					<a href="" @click.prevent="hidePrize()" class="modal-dismiss">
						<i class="icon_close"></i>
					</a>
					<h2>
						Yay you got the prize!!
					</h2>
					<h1> {{prizeName}}</h1>
                    <button @click.prevent="claimPrice" class="btn btn-primary">Claim Reward</button>
				</div>
			</div>
		</section>
</template>


<script>
import * as Winwheel from './Winwheel'

export default {
  name: 'VueWinWheel',
  props:{
		segments:{
			default(){
				return [
					{
						textFillStyle: '#fff',
						fillStyle: '#5e2e87',
						text:'5% discount'
					},
					{
						textFillStyle: '#000',
						fillStyle: '#e1cdf1',
						text:'7% discount'
					},
					{
						textFillStyle: '#fff',
						fillStyle: '#5e2e87',
						text:'8% discount'
					},
					{
						textFillStyle: '#000',
						fillStyle: '#e1cdf1',
						text:'9% discount'
					},
					{
						textFillStyle: '#fff',
						fillStyle: '#5e2e87',
						text:'10% discount'
					},
					{
						textFillStyle: '#000',
						fillStyle: '#e1cdf1',
						text:'12% discount'
					},
					{
						textFillStyle: '#fff',
						fillStyle: '#5e2e87',
						text:'14% discount'
					},
					{
						textFillStyle: '#000',
						fillStyle: '#e1cdf1',
						text:'20% discount'
					}
				]
			}
		}
  },
  data () {
    return {
      loadingPrize: false,
      theWheel: null,
      modalPrize: false,
      wheelPower: 1,
      wheelSpinning: false,
      prizeName: 'BUY 1 GET 1',
      useCount: 0,
      claimCount: 1,
      WinWheelOptions: {
        textFontSize: 14,
        outterRadius: 410,
        innerRadius: 25,
        lineWidth: 8,
        animation: {
          type: 'spinOngoing',
          duration: 0.5
        }
      }
    }
  },
  methods: {
    showPrize () {
      this.modalPrize = true
    },
    claimPrice () {
        if(this.claimCount == 1) {
            this.$confirm('Are you sure want to claim this gift?', 'Warning', {
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancel',
            type: 'warning'
            }).then(() => {
                const priceAmount = this.prizeName.split(' ')[0]
                const couponPrice = priceAmount.split('%')[0]
                axios.post('/claim-gift', {'price': this.prizeName,'couponPrice': couponPrice, 'useCount': this.useCount})
                .then((result) => {
                    this.claimCount += 1;
                    if(result.data.msg) {
                        console.log(result);
                        this.$message({
                            showClose: true,
                            message: result.data,
                            type: 'error'
                        });
                    }
                    else {
                        this.$message({
                            showClose: true,
                            message: result.data,
                            type: 'success'
                        });
                    }
                    }).catch((error) => {
                        console.log(error)
                    });
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: 'gift did non claimed'
                });
            });
        }
        else {
            this.$message({
                type: 'error',
                message: 'You have already claimed the coupon'
            });
        }
        
    },
    hidePrize () {
      this.modalPrize = false
    },
    startSpin () {
        if(this.useCount >= 3) {
            this.resetWheel();
            this.$message({
                showClose: true,
                message: 'You cant Spin more then 3 times',
                type: 'error'
            });
        }
      else if (this.wheelSpinning === false) {
        this.theWheel.startAnimation()
        this.wheelSpinning = true
        this.theWheel = new Winwheel.Winwheel({
          ...this.WinWheelOptions,
          numSegments: this.segments.length,
          segments: this.segments,
          animation: {
            type: 'spinToStop',
            duration: 5,
            spins: 5,
            callbackFinished: this.onFinishSpin
          }
        })

        // example input prize number get from Backend
        // Important thing is to set the stopAngle of the animation before stating the spin.

        var prizeNumber = Math.floor(Math.random() * this.segments.length) // or just get from Backend
        var stopAt = 360 / this.segments.length * prizeNumber - 360 / this.segments.length / 2 // center pin
        // var stopAt = 360 / this.segments.length * prizeNumber - Math.floor(Math.random() * 60) //random location
        this.theWheel.animation.stopAngle = stopAt
        this.useCount += 1;
        console.log(this.useCount);
        this.theWheel.startAnimation()
        this.wheelSpinning = false
      }
    },
    resetWheel () {
      this.theWheel = new Winwheel.Winwheel({
        ...this.WinWheelOptions,
        numSegments: this.segments.length,
        segments: this.segments
      })

      if (this.wheelSpinning) {
        this.theWheel.stopAnimation(false) // Stop the animation, false as param so does not call callback function.
      }

      this.theWheel.rotationAngle = 0 // Re-set the wheel angle to 0 degrees.
      this.theWheel.draw() // Call draw to render changes to the wheel.
      this.wheelSpinning = false // Reset to false to power buttons and spin can be clicked again.
    },
    initSpin () {
      this.loadingPrize = true
            this.resetWheel()
            this.loadingPrize = false
    },
    onFinishSpin (indicatedSegment) {
      this.prizeName = indicatedSegment.text
      this.showPrize()
    }
  },
  computed: {},
  updated () {},
  mounted () {
    this.initSpin()
    // this.resetWheel()
  },
  created () {}
}

</script>

<style scoped>
.vue-winwheel {
	text-align: center;
	background-image: url('/static/img/obstacle-run/bg-spinner-mobile.svg');
	background-size: cover;
	background-position: center bottom;
	background-repeat: no-repeat;
}
.vue-winwheel h1 {
	color: #5e2e87;
	font-family: 'Avenir', Helvetica, Arial, sans-serif;
	font-size: 36px;
	line-height: 90px;
	letter-spacing: 4px;
	margin: 0;
}
.vue-winwheel h2 {
	margin: 0;
}
.vue-winwheel #modalSpinwheel.custom-modal .content-wrapper .content {
	width: calc(100vw - 30px);
	padding-top: 52px;
}
.vue-winwheel #modalSpinwheel.custom-modal .content-wrapper .content h2 {
	text-transform: uppercase;
	color: #5e2e87;
	margin-bottom: 16px;
	margin-top: 0;
	font-family: 'Avenir', Helvetica, Arial, sans-serif;
	font-size: 18px;
	letter-spacing: 1.1px;
	margin: 0;
}
.vue-winwheel #modalSpinwheel.custom-modal .content-wrapper .content p {
	font-family: 'Avenir', Helvetica, Arial, sans-serif;
	font-size: 10px;
	color: black;
	text-align: center;
	line-height: 25px;
}
.vue-winwheel #modalSpinwheel.custom-modal .content-wrapper .content p strong {
	font-family: 'Avenir', Helvetica, Arial, sans-serif;
}
.vue-winwheel #modalSpinwheel.custom-modal .content-wrapper .content .modal-dismiss {
	top: 12px;
	right: 12px;
}
.vue-winwheel #modalSpinwheel.custom-modal .content-wrapper .content .modal-dismiss i.icon_close {
	font-size: 30px;
	color: #da2a52;
}
.vue-winwheel canvas#canvas {
	position: relative;
}
.vue-winwheel .canvas-wrapper {
	position: relative;
}
.vue-winwheel .canvas-wrapper:after {
	content: '';
	display: block;
	width: 42px;
	background: #5e2e87;
	height: 42px;
	position: absolute;
	left: calc(50% - 25px);
	margin: auto;
	border-radius: 100%;
	top: calc(50% - 29px);
	border: 5px solid white;
	box-sizing: content-box;
}
.vue-winwheel .canvas-wrapper:before {
	content: '';
	display: block;
	width: 310px;
	background: #21132c;
	height: 310px;
	position: absolute;
	left: 0;
	right: 0;
	margin: 0 auto;
	border-radius: 100%;
	top: 0;
}
.vue-winwheel .wheel-wrapper {
	position: relative;
}
.vue-winwheel .wheel-wrapper:before {
	content: '';
	width: 62px;
	height: 47px;
	position: absolute;
	top: -10px;
	left: calc(50% - 31px);
	right: 0;
	display: block;
	z-index: 99999;
	background-image: url('./spinner-marker.svg');
	background-repeat: no-repeat;
	background-size: contain;
	background-position: center;
}
.vue-winwheel .wheel-wrapper .button-wrapper {
	margin: 0 auto;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	width: 231px;
	height: 118px;
}
.vue-winwheel .wheel-wrapper .btn.btn-play {
	padding: 0 58px !important;
	background: #5e2e87;
	height: 40px;
	line-height: 40px;
	color: white;
	font-weight: bold;
	text-decoration: none;
	border-radius: 2px;
	font-family: 'Avenir', Helvetica, Arial, sans-serif;
	letter-spacing: 2px;
}
.btn .btn-primary {
    background: #5e2e87;
    color: white;
}
.main-text {
    font-size: 30px;
}
</style>
