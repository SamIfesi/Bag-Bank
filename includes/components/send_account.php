 <main class="send-container">
     <section id="recipient-section" class="">
         <div class="section" id="">
             <label for="recipient">Recipient</label>
             <div class="input-group">
                 <i class="ti ti-user send-icon"></i>
                 <input
                     type="text"
                     class="input"
                     id="recipient"
                     pattern="\d{10}"
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

         <button class="btn-send" id="nextBtn" disabled>
             Next
         </button>
     </section>