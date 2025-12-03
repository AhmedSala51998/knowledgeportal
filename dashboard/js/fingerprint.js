/*
  fingerprint.js
  يولّد fingerprint و يرسله للسيرفر ليُسجل الزيارة
*/

(async function() {
  // توليف بيانات بسيطة
  function getBasic() {
    return [
      navigator.userAgent || '',
      navigator.platform || '',
      navigator.language || '',
      (screen && screen.width ? screen.width + "x" + screen.height : ''),
      String(new Date().getTimezoneOffset()),
      navigator.hardwareConcurrency || '',
      navigator.deviceMemory || ''
    ].join('###');
  }

  // Canvas fingerprint (رسمة خفيفة)
  function getCanvasFp() {
    try {
      const canvas = document.createElement('canvas');
      const ctx = canvas.getContext('2d');
      ctx.textBaseline = "top";
      ctx.font = "14px 'Arial'";
      ctx.textBaseline = "alphabetic";
      ctx.fillStyle = "#f60";
      ctx.fillRect(125,1,62,20);
      ctx.fillStyle = "#069";
      ctx.fillText("Fingerprint🙂", 2, 15);
      ctx.fillStyle = "rgba(102, 204, 0, 0.7)";
      ctx.fillText("Fingerprint🙂", 4, 17);
      return canvas.toDataURL();
    } catch(e) {
      return '';
    }
  }

  // WebGL renderer info (optional)
  function getWebGLFp() {
    try {
      const canvas = document.createElement('canvas');
      const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
      if (!gl) return '';
      const debugInfo = gl.getExtension('WEBGL_debug_renderer_info');
      const vendor = debugInfo ? gl.getParameter(debugInfo.UNMASKED_VENDOR_WEBGL) : '';
      const renderer = debugInfo ? gl.getParameter(debugInfo.UNMASKED_RENDERER_WEBGL) : '';
      return vendor + '~~' + renderer;
    } catch(e) {
      return '';
    }
  }

  // Hash function SHA-256 -> hex
  async function sha256hex(str) {
    const enc = new TextEncoder();
    const buf = await crypto.subtle.digest('SHA-256', enc.encode(str));
    return Array.prototype.map.call(new Uint8Array(buf), x => ('00' + x.toString(16)).slice(-2)).join('');
  }

  // جمع البيانات
  const data = [
    getBasic(),
    getCanvasFp(),
    getWebGLFp()
  ].join('||');

  const fp = await sha256hex(data);

  // ضع cookie محلياً (مدة سنة)
  document.cookie = "fpid=" + fp + "; path=/; max-age=" + (365*24*60*60) + "; SameSite=Lax";

  // أرسل للسيرفر لتسجيل/استرجاع visitor_id (POST)
  const payload = {
    fingerprint: fp,
    page_url: location.pathname + location.search,
    search_query: (new URLSearchParams(location.search)).get('search') || ''
  };

  try {
    await fetch('../../fp_register.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'same-origin',
      body: JSON.stringify(payload)
    });
    // لا نحتاج الاستجابة هنا، السيرفر يضع cookie visitor_id
  } catch (e) {
    // لا نقطع عرض الصفحة لو فشل الاتصال
    console.warn('FP registration failed', e);
  }
})();