<?php
/**
 * Created by PhpStorm.
 * User: Faizan
 * Date: 2019-03-04
 * Time: 23:36
 */

class PaymentGateways extends MY_Controller {

	function payment_init() {
		$params = $this->input->get();
		if ( $params['payment_gateway'] == 1 ) {

		} else if ( $params['payment_gateway'] == 2 ) {

		} else if ( $params['payment_gateway'] == 3 ) {

		} else if ( $params['payment_gateway'] == 4 ) {
			$pp_Version           = "1.1";
			$pp_TxnType           = "";
			$pp_Language          = "EN";
			$pp_MerchantID        = "MC4944";
			$pp_SubMerchantID     = "";
			$pp_Password          = "34by8scg8f";
			$pp_BankID            = "TBANK";
			$pp_ProductID         = "RETL";
			$pp_TxnDateTime       = date( "Ymdhis" );
			$pp_TxnRefNo          = $params['order_id'];
			$pp_Amount            = 1000;
			$pp_TxnCurrency       = "PKR";
			$pp_BillReference     = "Booking";
			$pp_Description       = "Description";
			$pp_ReturnURL         = "http://localhost/travelhope_net/paymentGateways/payment_success?payment_gateway=" . $params['payment_gateway'] . "&order_id=" . $params['order_id'];
			$pp_TxnExpiryDateTime = date( 'Ymdhis', strtotime( date( "Y-m-d h:i:s" ) . "+1 day" ) );
			$ppmpf_1              = 1;
			$ppmpf_2              = 2;
			$ppmpf_3              = 3;
			$ppmpf_4              = 4;
			$ppmpf_5              = 5;
			$salt                 = "cy9w30f801";
			$hashString           = $salt . "&" . $pp_Amount . "&TBANK&" . $pp_BillReference . "&" . $pp_Description . "&" . $pp_Language . "&" . $pp_MerchantID . "&" . $pp_Password . "&RETL&" . $pp_ReturnURL . "&" . $pp_TxnCurrency . "&" . $pp_TxnDateTime . "&" . $pp_TxnExpiryDateTime . "&" . $pp_TxnRefNo . "&1.1&1&2&3&4&5";
			$secureHash           = hash_hmac( 'sha256', $hashString, $salt );
			?>
            <br>
            <br>
            <hr>
            <h1 style="text-align: center">Redirecting to you Jazz Cash</h1>
            <form name="jsform" method="post" id="jazzcashform"
                  action="https://sandbox.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform/">
                <input type="hidden" name="pp_Version" value="<?= $pp_Version ?>">
                <input type="hidden" name="pp_TxnType" value="<?= $pp_TxnType ?>">
                <input type="hidden" name="pp_Language" value="<?= $pp_Language ?>">
                <input type="hidden" name="pp_MerchantID" value="<?= $pp_MerchantID ?>">
                <input type="hidden" name="pp_SubMerchantID" value="<?= $pp_SubMerchantID ?>">
                <input type="hidden" name="pp_Password" value="<?= $pp_Password ?>">
                <input type="hidden" name="pp_BankID" value="<?= $pp_BankID ?>">
                <input type="hidden" name="pp_ProductID" value="<?= $pp_ProductID ?>">
                <input type="hidden" name="pp_TxnRefNo" value="<?= $pp_TxnRefNo ?>">
                <input type="hidden" name="pp_Amount" value="<?= $pp_Amount ?>">
                <input type="hidden" name="pp_TxnCurrency" value="<?= $pp_TxnCurrency ?>">
                <input type="hidden" name="pp_TxnDateTime" value="<?= $pp_TxnDateTime ?>">
                <input type="hidden" name="pp_BillReference" value="<?= $pp_BillReference ?>">
                <input type="hidden" name="pp_Description" value="<?= $pp_Description ?>">
                <input type="hidden" name="pp_ReturnURL" value="<?= $pp_ReturnURL ?>">
                <input type="hidden" name="pp_TxnExpiryDateTime" value="<?= $pp_TxnExpiryDateTime ?>">
                <input type="hidden" name="pp_SecureHash" value="<?= $secureHash ?>">
                <input type="hidden" name="ppmpf_1" value="<?= $ppmpf_1 ?>">
                <input type="hidden" name="ppmpf_2" value="<?= $ppmpf_2 ?>">
                <input type="hidden" name="ppmpf_3" value="<?= $ppmpf_3 ?>">
                <input type="hidden" name="ppmpf_4" value="<?= $ppmpf_4 ?>">
                <input type="hidden" name="ppmpf_5" value="<?= $ppmpf_5 ?>">
            </form>
            <hr>
            <script>
                document.jsform.submit();
            </script>
			<?php
		}
	}

	function payment_success() {
		$payment_getway = $this->input->get( 'payment_gateway' );
		if ( ! empty( $this->input->get( 'order_id' ) ) ) {
			$post = [
				'ota_id'     => $this->getOTAdata()->ota->ota_id,
				'invoice_id' => $this->input->get( 'order_id' ),
			];

            ($payment_getway);

			$api_response = ( curl_server_request( $post, APPURL . "ota/hotels/invoice" ) );
			$api_response = json_decode( $api_response['data'], true );

			if ( $api_response['status'] == "success" ) {
				$super_booking_id = $api_response['data']['super_booking']['id'];

				// Paypal
				if ( $payment_getway == 1 ) {
					$this->Paypal( $super_booking_id, $api_response['data']['super_booking']['model_id'] );
				} // Easy Paisa
				else if ( $payment_getway == 2 ) {

				} // PayU
				else if ( $payment_getway == 3 ) {
					$this->PayU( $super_booking_id , $api_response['data']['super_booking']['model_id']);
				} // JazzCash
				else if ( $payment_getway == 4 ) {
					$this->jazz_cash( $super_booking_id , $api_response['data']['super_booking']['model_id']);
				}
			} else {
			    redirect(site_url());
            }
		}
	}

	function modules($id) {
		$modules = array(
			'hotels',
			'flights'
		);

		return $modules[$id];
    }

	function jazz_cash( $super_booking_id, $module_id ) {
		if ( $this->input->post( 'pp_ResponseCode' ) == 000 ) {
			$this->update_invoice( "paid", "" );
			redirect( $this->modules($module_id).'/invoice/' . $super_booking_id );
		} else {
			$this->update_invoice( "pending", $this->input->post( 'pp_ResponseMessage' ) );
			redirect( $this->modules($module_id).'/invoice/' . $super_booking_id );
		}
	}

	function PayU( $super_booking_id, $module_id ) {
		$this->update_invoice( "paid", "" );
		redirect( $this->modules($module_id).'/invoice/' . $super_booking_id );
	}

	function Paypal( $super_booking_id, $module_id ) {
		$this->update_invoice( "paid", "" );
		redirect( $this->modules($module_id).'hotels/invoice/' . $super_booking_id );
	}

	function update_invoice( $status, $message ) {
		$post                   = $this->input->get();
		$post['payment_status'] = $status;
		$post['message']        = $message;
		$post['ota_id']         = $this->getOTAdata()->ota->ota_id;
		$data                   = curl_server_request( $post, APPURL . "gateways/update_invoice" );

		return $data['data'];
	}


}