(function($) {
"use strict";

var justgLocation = {
	storeCountry: function () {
		if (!justgLocation.getCountry().length) {
			$.getJSON(justg_params.json.country_url, function (data) {
				data.sort(function (a, b) {
					return (a.country_name > b.country_name) ? 1 : ((b.country_name > a.country_name) ? -1 : 0);
				});
				Lockr.set(justg_params.json.country_key, data);
			});
		}
	},
	getCountry: function (search, searchMethod) {
		var items = Lockr.get(justg_params.json.country_key);
		if (!items || typeof items === 'undefined') {
			return [];
		}

		if (search && search === Object(search)) {
			return justgLocation.searchLocation(items, search, searchMethod);
		}

		return items;
	},
	storeProvince: function () {
		if (!justgLocation.getProvince().length) {
			$.getJSON(justg_params.json.province_url, function (data) {
				data.sort(function (a, b) {
					return (a.province_name > b.province_name) ? 1 : ((b.province_name > a.province_name) ? -1 : 0);
				});
				Lockr.set(justg_params.json.province_key, data);
			});
		}
	},
	getProvince: function (search, searchMethod) {
		var items = Lockr.get(justg_params.json.province_key);
		if (!items || typeof items === 'undefined') {
			return [];
		}

		if (search && search === Object(search)) {
			return justgLocation.searchLocation(items, search, searchMethod);
		}

		return items;
	},
	storeCity: function () {
		if (!justgLocation.getCity().length) {
			$.getJSON(justg_params.json.city_url, function (data) {
				data.sort(function (a, b) {
					return (a.city_name > b.city_name) ? 1 : ((b.city_name > a.city_name) ? -1 : 0);
				});
				Lockr.set(justg_params.json.city_key, data);
			});
		}
	},
	getCity: function (search, searchMethod) {
		var items = Lockr.get(justg_params.json.city_key);
		if (!items || typeof items === 'undefined') {
			return [];
		}

		if (search && search === Object(search)) {
			return justgLocation.searchLocation(items, search, searchMethod);
		}

		return items;
	},
	storeSubdistrict: function () {
		if (!justgLocation.getSubdistrict().length) {
			$.getJSON(justg_params.json.subdistrict_url, function (data) {
				data.sort(function (a, b) {
					return (a.subdistrict_name > b.subdistrict_name) ? 1 : ((b.subdistrict_name > a.subdistrict_name) ? -1 : 0);
				});
				Lockr.set(justg_params.json.subdistrict_key, data);
			});
		}
	},
	getSubdistrict: function (search, searchMethod) {
		var items = Lockr.get(justg_params.json.subdistrict_key);
		if (!items || typeof items === 'undefined') {
			return [];
		}

		if (search && search === Object(search)) {
			return justgLocation.searchLocation(items, search, searchMethod);
		}

		return items;
	},
	searchLocation: function (items, search, searchMethod) {
		if (searchMethod === 'filter') {
			return items.filter(function (item) {
				return justgLocation.isLocationMatch(item, search);
			});
		}

		return items.find(function (item) {
			return justgLocation.isLocationMatch(item, search);
		});
	},
	isLocationMatch: function (item, search) {
		var isItemMatch = true;
		for (var key in search) {
			if (!item.hasOwnProperty(key) || String(item[key]).toLowerCase() !== String(search[key]).toLowerCase()) {
				isItemMatch = false;
			}
		}
		return isItemMatch;
	}
};

justgLocation.storeCountry(); // Store custom country data to local storage.
justgLocation.storeProvince(); // Store custom province data to local storage.
justgLocation.storeCity(); // Store custom city data to local storage.
justgLocation.storeSubdistrict(); // Store custom subdistrict data to local storage.

var justgBackend = {
	init: function () {
		justgBackend.bindEvents();
		justgBackend.maybeOpenModal();
	},
	bindEvents: function () {
		$(document.body).off('click', '.wc-shipping-zone-method-settings');
		$(document.body).on('click', '.wc-shipping-zone-method-settings', function (e) {
			$(document.body).off('wc_backbone_modal_loaded', justgBackend.loadForm);

			if ($(e.currentTarget).closest('tr').find('.wc-shipping-zone-method-type').text() === justg_params.method_title) {
				$(document.body).on('wc_backbone_modal_loaded', justgBackend.loadForm);
			}
		});

		$(document.body).off('wc_backbone_modal_loaded', justgBackend.initSortable);
		$(document.body).on('wc_backbone_modal_loaded', justgBackend.initSortable);

		$(document.body).off('change', '#woocommerce_justg_origin_province', justgBackend.loadFormCity);
		$(document.body).on('change', '#woocommerce_justg_origin_province', justgBackend.loadFormCity);

		$(document.body).off('change', '#woocommerce_justg_origin_city', justgBackend.loadFormSubdistrict);
		$(document.body).on('change', '#woocommerce_justg_origin_city', justgBackend.loadFormSubdistrict);

		$(document.body).off('change', '#woocommerce_justg_account_type', justgBackend.highlightFeature);
		$(document.body).on('change', '#woocommerce_justg_account_type', justgBackend.highlightFeature);

		$(document.body).off('change', '#woocommerce_justg_account_type', justgBackend.toggleCouriersBox);
		$(document.body).on('change', '#woocommerce_justg_account_type', justgBackend.toggleCouriersBox);

		$(document.body).off('change', '#woocommerce_justg_account_type', justgBackend.toggleVolumetricConverter);
		$(document.body).on('change', '#woocommerce_justg_account_type', justgBackend.toggleVolumetricConverter);

		$(document.body).off('change', '#woocommerce_justg_volumetric_calculator', justgBackend.toggleVolumetricDivider);
		$(document.body).on('change', '#woocommerce_justg_volumetric_calculator', justgBackend.toggleVolumetricDivider);

		$(document.body).off('change', '.justg-account-type', justgBackend.selectAccountType);
		$(document.body).on('change', '.justg-account-type', justgBackend.selectAccountType);

		$(document.body).off('change', '.justg-service--bulk', justgBackend.selectServicesBulk);
		$(document.body).on('change', '.justg-service--bulk', justgBackend.selectServicesBulk);

		$(document.body).off('change', '.justg-service--single', justgBackend.selectServices);
		$(document.body).on('change', '.justg-service--single', justgBackend.selectServices);

		$(document.body).off('click', '.justg-couriers-toggle', justgBackend.toggleServicesItems);
		$(document.body).on('click', '.justg-couriers-toggle', justgBackend.toggleServicesItems);
	},
	maybeOpenModal: function () {
		if (justg_params.show_settings) {
			setTimeout(function () {
				// Try show settings modal on settings page.
				var isMethodAdded = false;
				var methods = $(document).find('.wc-shipping-zone-method-type');
				for (var i = 0; i < methods.length; i++) {
					var method = methods[i];
					if ($(method).text() === justg_params.method_title) {
						$(method).closest('tr').find('.row-actions .wc-shipping-zone-method-settings').trigger('click');
						isMethodAdded = true;
						return;
					}
				}

				// Show Add shipping method modal if the shipping is not added.
				if (!isMethodAdded) {
					$('.wc-shipping-zone-add-method').trigger('click');
					$('select[name="add_method_id"]').val(justg_params.method_id).trigger('change');
				}

			}, 300);
		}
	},
	loadForm: function () {
		var provinceData = justgLocation.getProvince();
		var provinceParam = {
			data: [],
			placeholder: justg_params.text.placeholder.state
		};

		if (provinceData.length) {
			for (var i = 0; i < provinceData.length; i++) {
				provinceParam.data.push({
					id: provinceData[i].province_id,
					text: provinceData[i].province,
				});
			}
		}

		$('#woocommerce_justg_origin_province').selectWoo(provinceParam).trigger('change');

		$('#woocommerce_justg_account_type').trigger('change');
	},
	loadFormCity: function () {
		var cityParam = {
			data: [],
			placeholder: justg_params.text.placeholder.city
		};
		var $cityField = $('#woocommerce_justg_origin_city');
		var citySelected = $cityField.val();
		var cityMatch = '';

		var provinceSelected = $('#woocommerce_justg_origin_province').val();
		var provinceData = justgLocation.getProvince({ province_id: provinceSelected });
		if (provinceData) {
			var cityData = justgLocation.getCity({ province_id: provinceData.province_id }, 'filter');
			if (cityData) {
				for (var i = 0; i < cityData.length; i++) {
					cityParam.data.push({
						id: cityData[i].city_id,
						text: cityData[i].type + ' ' + cityData[i].city_name,
					});

					if (citySelected === cityData[i].city_id) {
						cityMatch = cityData[i].city_id;
					}
				}
			}
		}

		$('#woocommerce_justg_origin_city').selectWoo(cityParam).val(cityMatch).trigger('change');
		$('#woocommerce_justg_volumetric_calculator').trigger('change');
	},
	loadFormSubdistrict: function () {
		var subdistrictParam = {
			data: [],
			placeholder: justg_params.text.placeholder.address_2
		};
		var $subdistrictField = $('#woocommerce_justg_origin_subdistrict');
		var subdistrictSelected = $subdistrictField.val();
		var subdistrictMatch = '';

		var citySelected = $('#woocommerce_justg_origin_city').val();
		var cityData = justgLocation.getCity({ city_id: citySelected });
		if (cityData) {
			var subdistrictData = justgLocation.getSubdistrict({ city_id: cityData.city_id }, 'filter');
			if (subdistrictData) {
				for (var i = 0; i < subdistrictData.length; i++) {
					subdistrictParam.data.push({
						id: subdistrictData[i].subdistrict_id,
						text: subdistrictData[i].subdistrict_name,
					});

					if (subdistrictSelected === subdistrictData[i].subdistrict_id) {
						subdistrictMatch = subdistrictData[i].subdistrict_id;
					}
				}
			}
		}

		$('#woocommerce_justg_origin_subdistrict').selectWoo(subdistrictParam).val(subdistrictMatch).trigger('change');
	},
	selectAccountType: function (e) {
		e.preventDefault();

		var selected = $(this).val();

		$(this).closest('tr').find('input').not($(this)).prop('disabled', false).prop('checked', false);

		$(this).prop('disabled', true);

		$('#woocommerce_justg_account_type').val(selected).trigger('change');
	},
	highlightFeature: function (e) {
		var selected = $(e.currentTarget).val();
		$('#justg-account-features').find('td, th')
			.removeClass('selected');
		$('#justg-account-features')
			.find('.justg-account-features-col-' + selected)
			.addClass('selected');
	},
	toggleVolumetricConverter: function (e) {
		var $accountType = $('#woocommerce_justg_account_type');
		var accounts = $accountType.data('accounts');
		var account = accounts[$(e.currentTarget).val()] || false;

		if (!account) {
			return;
		}

		if (!account.volumetric) {
			$('#woocommerce_justg_volumetric_calculator, #woocommerce_justg_volumetric_divider').closest('tr').hide();
		} else {
			$('#woocommerce_justg_volumetric_calculator').trigger('change').closest('tr').show();
		}
	},
	toggleVolumetricDivider: function (e) {
		var checked = $(e.currentTarget).is(':checked');

		if (checked) {
			$('#woocommerce_justg_volumetric_divider').closest('tr').show();
		} else {
			$('#woocommerce_justg_volumetric_divider').closest('tr').hide();
		}
	},
	toggleCouriersBox: function () {
		var $accountType = $('#woocommerce_justg_account_type');
		var accounts = $accountType.data('accounts');
		var couriers = $accountType.data('couriers');
		var account = $accountType.val();

		_.each(couriers, function (zoneCouriers, zoneId) {
			var selected_couriers = 0;

			var couriersAccount = _.find(couriers[zoneId], function (courier) {
				return courier.account.indexOf(account) !== -1;
			});

			_.each(zoneCouriers, function (courier, courierId) {
				if (courier.account.indexOf(account) === -1) {
					$('.justg-couriers-item--' + zoneId + '--' + courierId).slideUp();
					$('.justg-couriers-item--' + zoneId + '--' + courierId).find('.justg-service').prop('checked', false);
				} else {
					$('.justg-couriers-item--' + zoneId + '--' + courierId).slideDown();
				}

				if (!accounts[account].multiple_couriers) {
					if (selected_couriers) {
						$('.justg-couriers-item--' + zoneId + '--' + courierId).find('.justg-service').prop('checked', false);
					}

					if ($('.justg-couriers-item--' + zoneId + '--' + courierId).find('.justg-service--single:checked').length) {
						selected_couriers++;
					}
				}

				justgBackend.updateSelectedServicesCounter($('.justg-couriers-item--' + zoneId + '--' + courierId));
			});

			if (!couriersAccount) {
				$('.justg-couriers-wrap--' + zoneId).hide();
			} else {
				$('.justg-couriers-wrap--' + zoneId).show();
			}
		});
	},
	selectServicesBulk: function () {
		var courierId = $(this).closest('.justg-couriers-item').data('id');
		var zoneId = $(this).closest('.justg-couriers-item').data('zone');
		var $accountType = $('#woocommerce_justg_account_type');
		var account = $accountType.val();
		var accounts = $accountType.data('accounts');

		if ($(this).is(':checked')) {
			$(this).closest('.justg-couriers-item').find('.justg-service--single').prop('checked', true);

			if (!accounts[account].multiple_couriers) {
				$('.justg-couriers-item').not('.justg-couriers-item--' + zoneId + '--' + courierId).each(function () {
					$(this).find('.justg-service').prop('checked', false);
					justgBackend.updateSelectedServicesCounter($(this));
				});
			}
		} else {
			$(this).closest('.justg-couriers-item-inner').find('.justg-service--single').prop('checked', false);
		}

		justgBackend.updateSelectedServicesCounter($('.justg-couriers-item--' + zoneId + '--' + courierId));
	},
	selectServices: function () {
		var courierId = $(this).closest('.justg-couriers-item').data('id');
		var zoneId = $(this).closest('.justg-couriers-item').data('zone');
		var $accountType = $('#woocommerce_justg_account_type');
		var account = $accountType.val();
		var accounts = $accountType.data('accounts');

		if ($(this).is(':checked')) {
			$(this).closest('.justg-couriers-item').find('.justg-service--bulk').prop('checked', true);

			if (!accounts[account].multiple_couriers) {
				$('.justg-couriers-item').not('.justg-couriers-item--' + zoneId + '--' + courierId).each(function () {
					$(this).find('.justg-service').prop('checked', false);
					justgBackend.updateSelectedServicesCounter($(this));
				})
			}
		} else {
			if (!$(this).closest('.justg-services').find('.justg-service--single:checked').length) {
				$(this).closest('.justg-couriers-item').find('.justg-service--bulk').prop('checked', false);
			}
		}

		justgBackend.updateSelectedServicesCounter($('.justg-couriers-item--' + zoneId + '--' + courierId));
	},
	updateSelectedServicesCounter: function ($selector) {
		$selector.find('.justg-couriers--selected').text($selector.find('.justg-service--single:checked').length);
	},
	toggleServicesItems: function (event) {
		event.preventDefault();

		$(event.currentTarget)
			.find('.dashicons')
			.toggleClass('dashicons-admin-generic dashicons-arrow-up-alt2')
			.closest('.justg-couriers-item')
			.toggleClass('expanded');
	},
	initSortable: function () {
		$(".justg-couriers").sortable({
			axis: 'y',
			cursor: 'move',
		});
	},
}

$(document).ready(justgBackend.init);
}(jQuery));
