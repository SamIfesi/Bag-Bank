<form class="hide" id="amount-section">
    <button class="back-btn" id="backToAccountBtn">
        <i class="ti ti-chevron-left"></i>
    </button>
    <div class="details" id="user">
        <span class="img">
            <img src="public/logo-icon.svg" alt="bank logo" />
        </span>
        <span class="user-detail">
            <h3 id="recipient-name"></h3>
            <div class="user-account">
                <p id="recipient-account"></p>
                <p id="recipient-bank"></p>
            </div>
        </span>
    </div>
    <div class="section">
        <label for="amount">Amount</label>
        <div class="input-group">
            <span class="send-icon">₦</span>
            <input
                type="text"
                class="input"
                id="amount"
                placeholder="0.00"
                inputmode="decimal"
                data-max="1000000" />
        </div>
        <span class="error" id="amount-error">
            The amount should be within ₦100.00 - ₦5,000,000.00
        </span>
    </div>

    <div class="section">
        <label for="description">Note</label>
        <input type="text" id="description" placeholder="What's this for? (Optional)" class="form-grp" />
    </div>

    <div class="quick-amounts">
        <button class="quick-btn" data-amount="500">₦500</button>
        <button class="quick-btn" data-amount="1000">₦1,000</button>
        <button class="quick-btn" data-amount="2000">₦2,000</button>
        <button class="quick-btn" data-amount="5000">₦5,000</button>
        <button class="quick-btn" data-amount="10000">₦10,000</button>
        <button class="quick-btn" data-amount="20000">₦20,000</button>
    </div>

    <button class="btn-send" id="confirmBtn" disabled>
        <!-- <i class="ti ti-send"></i> -->
        Next
    </button>

    <!-- confirmation -->
    <div class="model" id="model">
        <div class="confirm-model" id="confirm-model">
            <span class="drag-handle" id="drag"></span>
            <div class="model-header">
                <h3>Payment</h3>
                <i class="ti ti-x" id="close-confirm-model"></i>
            </div>
            <div class="summary">
                <div class="model-grp">
                    <span>Amount</span>
                    <span id="model-amount" class="txt"></span>
                </div>
                <div class="model-grp">
                    <span>Fee</span>
                    <span class="txt">₦0.00</span>
                </div>
                <div class="model-grp">
                    <span>Account Number</span>
                    <span id="model-account-number" class="txt"></span>
                </div>
                <div class="model-grp">
                    <span>Account Name</span>
                    <span id="model-account-name" class="txt"></span>
                </div>
                <div class="model-grp">
                    <span>Bank Name</span>
                    <span id="model-bank-name" class="txt"></span>
                </div>
            </div>
            <button type="button" class="btn-send" id="payBtn">Proceed</button>
        </div>
    </div>
</form>
</main>
<script type="module" src="public/assets/js/send.js"></script>
</body>

</html>