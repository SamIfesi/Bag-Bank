 <main class="send-container">
     <form id="account-section" class="hid">
         <div class="section" id="">
             <label for="recipient">Recipient</label>
             <div class="input-group">
                 <i class="ti ti-user send-icon"></i>
                 <input
                     type="text"
                     class="input"
                     id="recipient"
                     maxlength="10"
                     inputmode="numeric"
                     placeholder="Enter 10-digit Account No." />
             </div>
         </div>

         <div class="section">
             <label for="bank">Bank</label>
             <div class="input-group">
                 <i class="ti ti-building-bank send-icon"></i>
                 <select id="bank" class="input">
                     <option value="">Select Bank</option>
                     <?= $bank_options ?? ''; ?>
                 </select>
             </div>
         </div>

         <div class="section">
             <label for="name">Account Name</label>
             <input type="text" id="name" class="form-grp" aria-disabled="true" aria-readonly="true" disabled />
         </div>

         <span class="error" id="recipient-error">The amount should be within ₦100.00 - ₦5,000,000.00</span>

         <button class="btn-send" id="nextBtn" disabled>
             Next
         </button>
     </form>