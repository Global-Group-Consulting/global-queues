<?php

namespace App\Enums;

class AccountStatus {
  /** Created but not completed */
  const DRAFT = "draft";
  
  /** Waiting for user signature */
  const PENDING_SIGNATURE = "pending_signature";
  
  /** after user signature, waiting for agent confirmation */
  const PENDING_CONFIRM = "pending_confirm";
  
  /** Account created and waiting for serv clienti validation */
  const CREATED = "created";
  
  /** Account validate by serv clienti */
  const VALIDATED = "validated";
  
  /** Missing data to the account */
  const INCOMPLETE = "incomplete";
  
  /** Data completed and must revalidate */
  const MUST_REVALIDATE = "must_revalidate";
  
  /** Account approved by signing the contract */
  const APPROVED = "approved";
  
  /** Account activated by the user after the otp has been inserted */
  const ACTIVE = "active";
}
