let settings = [];
let taxClasses = [];
let taxRules = [];
let coupons = [];
document.addEventListener('DOMContentLoaded', reloadPage());
document.getElementById("submitAddCouponBtn").addEventListener("click", function () {
    const data = {
        action: "addCoupon",
        name: document.getElementById("couponName").value,
        code: document.getElementById("couponCode").value,
        description: document.getElementById("couponDescription").value,
        discount_type: document.getElementById("discountType").value,
        discount_amount: parseFloat(document.getElementById("discountAmount").value || 0),
        valid_from: document.getElementById("validFrom").value,
        valid_until: document.getElementById("validUntil").value,
        minimum_spend: parseFloat(document.getElementById("minimumSpend").value || 0),
        maximum_spend: parseFloat(document.getElementById("maximumSpend").value || 0),
        usage_limit: parseInt(document.getElementById("usageLimit").value || 0),
        usage_limit_per_user: parseInt(document.getElementById("usageLimitPerUser").value || 0),
        is_active: document.getElementById("couponActive").checked ? 1 : 0
    };

    fetch("/duanweb2/app/api/settings.api.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams(data),
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            alert("Coupon created successfully!");
           reloadPage();
            document.getElementById("couponName").value = "";
            const modal = bootstrap.Modal.getInstance(document.getElementById("addCouponModal"));
            modal.hide();
        } else {
            alert("Failed to create coupon!");
        }
    })
    .catch(err => {
        console.error("Error:", err);
        alert("Error while creating coupon!");
    });
});
async function reloadPage() {
    const response = await fetch('/duanweb2/app/api/settings.api.php?action=getSettings');
    const data = await response.json();

    if (data.success) {
        document.getElementById('storeName').value = data.general.name;
        document.getElementById('storeEmail').value = data.general.email;
        document.getElementById('storePhone').value = data.general.phone;
        document.getElementById('storeCurrency').value = data.general.currency;
        document.getElementById('minimumOrderAmount').value = data.general.minimum_order_amount;
        document.getElementById('deliveryFee').value = data.general.delivery_fee;
        document.getElementById('freeDeliveryEnabled').checked = data.general.free_delivery_enabled == 1;
        document.getElementById('freeDeliveryThreshold').value = data.general.free_delivery_threshold;


        renderCoupons(data.coupons);
        renderTaxClassOptions('taxClassSelect',data.tax.classes)
        renderGeneralTaxSettings(data.general)
        renderTaxRules(data.tax.rules);
        renderTaxClasses(data.tax.classes);


        settings = data.general;
        taxClasses = data.tax.classes;
        taxRules = data.tax.rules;
        coupons = data.coupons;

    }
}


document.querySelector('#addTaxRuleModal .btn-primary').addEventListener('click', function () {
    const taxClassId = document.getElementById('taxClassSelect').value;
    const name = document.getElementById('taxRuleName').value.trim();
    const rate = parseFloat(document.getElementById('taxRate').value);
    const country = document.getElementById('taxCountry').value;
    const state = document.getElementById('taxState').value;
    const priority = parseInt(document.getElementById('taxPriority').value);
    const active = document.getElementById('taxRuleActive').checked ? 1 : 0;

    if (!name || isNaN(rate)) {
        alert('Please fill in rule name and rate.');
        return;
    }

    const formData = new FormData();
    formData.append('action', 'addTaxRule');
    formData.append('tax_class_id', taxClassId);
    formData.append('name', name);
    formData.append('rate', rate);
    formData.append('country', country);
    formData.append('state', state);
    formData.append('priority', priority);
    formData.append('active', active);

    fetch('/duanweb2/app/api/settings.api.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Tax Rule added successfully!');
                $('#addTaxRuleModal').modal('hide');
                reloadPage();
            } else {
                alert('Failed to add tax rule.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Something went wrong!');
        });
});


function renderTaxClassOptions(componentId,taxClasses) {
    const select = document.getElementById(componentId);
    select.innerHTML = '<option value="">Select Tax Class</option>';

    taxClasses.forEach(cls => {
        const option = document.createElement('option');
        option.value = cls.id;
        option.textContent = cls.name;
        select.appendChild(option);
    });
}

function renderGeneralTaxSettings(taxGeneral) {

    document.getElementById('taxCalculationMethod').value = taxGeneral.tax_calculation_method;
    document.getElementById('defaultTaxRate').value = taxGeneral.default_tax_rate;
    document.getElementById('taxDisplayOption').value = taxGeneral.tax_display_option;
    document.getElementById('taxRounding').value = taxGeneral.tax_rounding;

    document.getElementById('enableTaxes').checked = taxGeneral.enable_taxes === 1 || taxGeneral.enable_taxes === true;
}

function renderCoupons(coupons) {
    const container = document.querySelector("#coupons .card-body");
    const existingCards = container.querySelectorAll('.coupon-card');
    existingCards.forEach(card => card.remove());

    coupons.forEach(coupon => {
        const statusClass = coupon.is_active === 1 ? 'bg-success' :
            coupon.status === 'upcoming' ? 'bg-warning' :
                coupon.status === 0 ? 'bg-danger' : 'bg-secondary';

        const card = document.createElement('div');
        card.className = 'coupon-card';

        card.innerHTML = `
            <span class="badge ${statusClass} coupon-status">${coupon.is_active === 1 ? "Hoạt động" : "Không hoạt động"}</span>
            <div class="coupon-card-header">
                <h5>${coupon.name}</h5>
                <div class="coupon-code">${coupon.code}</div>
            </div>
            <p>${coupon.description}</p>
            <div class="coupon-details">
                <div class="coupon-detail">
                    <div class="coupon-detail-label">Discount</div>
                    <div class="coupon-detail-value">${coupon.discount_amount}${coupon.discount_type === 'percentage' ? '%' : ' VNĐ'}</div>
                </div>
                <div class="coupon-detail">
                    <div class="coupon-detail-label">Valid From</div>
                    <div class="coupon-detail-value">${coupon.valid_from}</div>
                </div>
                <div class="coupon-detail">
                    <div class="coupon-detail-label">Valid Until</div>
                    <div class="coupon-detail-value">${coupon.valid_until}</div>
                </div>
                <div class="coupon-detail">
                    <div class="coupon-detail-label">Usage Limit</div>
                    <div class="coupon-detail-value">${coupon.used_count || 0} / ${coupon.usage_limit}</div>
                </div>
            </div>
            <div class="coupon-actions">
                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editCouponModal">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i> Delete
                </button>
                <button class="btn btn-sm btn-secondary">
                    <i class="fas fa-chart-bar"></i> Usage Stats
                </button>
            </div>
        `;

        container.appendChild(card);
    });
}
function renderTaxRules(rules) {
    const wrapper = document.querySelector("#tax .settings-section:nth-of-type(2)");
    const existing = wrapper.querySelectorAll('.tax-rule');
    existing.forEach(el => el.remove());

    rules.forEach(rule => {
        const taxRule = document.createElement('div');
        taxRule.className = 'tax-rule';

        taxRule.innerHTML = `
            <div class="tax-rule-header">
                <div class="tax-rule-title">${rule.name}</div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" ${rule.is_active ? 'checked' : ''}
                     onchange="toggleTaxRuleStatus('${rule.id}', this.checked)">
                    <label class="form-check-label">Active</label>
                </div>
            </div>
            <div class="tax-rule-details">
                <div class="tax-rule-detail">
                    <div class="tax-rule-detail-label">Rate</div>
                    <div class="tax-rule-detail-value">${rule.rate}%</div>
                </div>
                <div class="tax-rule-detail">
                    <div class="tax-rule-detail-label">Country</div>
                    <div class="tax-rule-detail-value">${rule.country || 'All'}</div>
                </div>
                <div class="tax-rule-detail">
                    <div class="tax-rule-detail-label">State</div>
                    <div class="tax-rule-detail-value">${rule.state || 'All States'}</div>
                </div>
                <div class="tax-rule-detail">
                    <div class="tax-rule-detail-label">Priority</div>
                    <div class="tax-rule-detail-value">${rule.priority}</div>
                </div>
            </div>
            <div class="tax-rule-actions">
                <button class="btn btn-sm btn-info" data-bs-toggle="modal"  data-bs-target="#editTaxRuleModal" onClick="editTaxRule(${rule.id}) " >
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </div>
        `;

        wrapper.appendChild(taxRule);
    });
}
function toggleTaxRuleStatus(taxRuleId, isActive) {
    fetch("/duanweb2/app/api/settings.api.php?action=updateTaxRuleStatus", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            id: taxRuleId,
            active: isActive ? 1 : 0
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log("Tax rule status updated successfully");
        } else {
            alert("Failed to update tax rule status");
        }
    })
    .catch(error => {
        console.error("Error updating tax rule status:", error);
        alert("Lỗi khi cập nhật trạng thái rule");
    });
}
function editTaxRule(ruleId) {

    renderTaxClassOptions('editTaxClassSelect', taxClasses);

    const rule = taxRules.find(r => r.id === ruleId);
    document.getElementById('editTaxRuleName').value = rule.name || '';
    document.getElementById('editTaxRate').value = rule.rate || 0;
    document.getElementById('editTaxCountry').value = rule.country || '';
    document.getElementById('editTaxState').value = rule.state || 'all';
    document.getElementById('editTaxPriority').value = rule.priority || 1;
    document.getElementById('editTaxRuleActive').checked = rule.is_active == 1;

    const taxClassSelect = document.getElementById('editTaxClassSelect');
    
    if (taxClassSelect) {
        taxClassSelect.value = rule.tax_class_id || '';
    }

  
    document.getElementById('editTaxRuleModal').setAttribute('data-id', rule.id);

    
}

function saveEditTaxRule(isActive) {
    const modal = document.getElementById('editTaxRuleModal');
    const taxRuleId = modal.getAttribute('data-id');

    const taxRule = {
        id: taxRuleId,
        tax_class_id: document.getElementById("editTaxClassSelect").value,
        name: document.getElementById("editTaxRuleName").value,
        rate: parseFloat(document.getElementById("editTaxRate").value),
        country: document.getElementById("editTaxCountry").value,
        state: document.getElementById("editTaxState").value,
        priority: parseInt(document.getElementById("editTaxPriority").value),
        active: document.getElementById("editTaxRuleActive").checked ? 1 : 0,
        action: "updateTaxRule"
    };

    fetch("/duanweb2/app/api/settings.api.php?action=updateTaxRule", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams(taxRule)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Tax Rule updated successfully!");
            reloadPage(); 
            const bsModal = bootstrap.Modal.getOrCreateInstance(modal);
            bsModal.hide();
        } else {
            alert("Failed to update tax rule.");
        }
    })
    .catch(error => {
        console.error("Error updating tax rule:", error);
        alert("Có lỗi xảy ra khi lưu tax rule.");
    });
}



function renderTaxClasses(classes) {
    const tbody = document.querySelector('#tax tbody');
    tbody.innerHTML = '';

    classes.forEach(cls => {
        tbody.innerHTML += `
            <tr>
                <td>${cls.name}</td>
                <td>${cls.description}</td>
                <td>
                    <div class="action-btns">
                        <button class="btn btn-sm btn-info" onclick="editTaxClass(${cls.id})"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-danger" onclick="deleteTaxClass(${cls.id})"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        `;
    });
}

document.getElementById('saveSettingsBtn').addEventListener('click', async () => {
    const formData = new FormData();
    formData.append('action', 'saveGeneralSettings');
    formData.append('name', document.getElementById('storeName').value);
    formData.append('email', document.getElementById('storeEmail').value);
    formData.append('phone', document.getElementById('storePhone').value);
    formData.append('currency', document.getElementById('storeCurrency').value);
    formData.append('minimum_order_amount', document.getElementById('minimumOrderAmount').value);
    formData.append('delivery_fee', document.getElementById('deliveryFee').value);
    formData.append('free_delivery_enabled', document.getElementById('freeDeliveryEnabled').checked ? 1 : 0);
    formData.append('free_delivery_threshold', document.getElementById('freeDeliveryThreshold').value);

    const response = await fetch('api/settings.php', {
        method: 'POST',
        body: formData
    });

    const result = await response.json();
    alert(result.message);
});