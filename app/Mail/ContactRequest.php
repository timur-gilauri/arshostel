<?php
	
	namespace App\Mail;
	
	use App\Entities\MailEntity;
	use Illuminate\Bus\Queueable;
	use Illuminate\Mail\Mailable;
	use Illuminate\Queue\SerializesModels;
	
	class ContactRequest extends Mailable
	{
		use Queueable, SerializesModels;
		
		protected $entity;
		
		/**
		 * Create a new message instance.
		 *
		 * @return void
		 */
		public function __construct(?MailEntity $entity)
		{
			$this->entity = $entity;
		}
		
		/**
		 * Build the message.
		 *
		 * @return $this
		 */
		public function build()
		{
			return $this->markdown('email.contact-request')
				->with('entity', $this->entity);
		}
	}
