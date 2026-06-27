export async function downloadHtmlAsPdf(source, filename = 'document.pdf') {
  // Try to use html2canvas + jsPDF for pixel-perfect capture and direct download
  let html2canvasMod = null;
  let jsPDFMod = null;
  try {
    html2canvasMod = await import('html2canvas');
  } catch (e) {
    html2canvasMod = null;
  }

  try {
    jsPDFMod = await import('jspdf');
  } catch (e) {
    jsPDFMod = null;
  }

  const isString = typeof source === 'string';
  let element = isString ? null : source;
  let created = false;

  if (isString) {
    element = document.createElement('div');
    element.style.position = 'absolute';
    element.style.left = '-9999px';
    element.innerHTML = source;
    document.body.appendChild(element);
    created = true;
  }

  // Attempt html2canvas + jsPDF capture
  if (html2canvasMod && jsPDFMod && element) {
    const html2canvas = (html2canvasMod && (html2canvasMod.default || html2canvasMod)) || null;
    const jsPDF = (jsPDFMod && (jsPDFMod.jsPDF || jsPDFMod.default || jsPDFMod)) || null;

    if (html2canvas && jsPDF) {
      try {
        const canvas = await html2canvas(element, { scale: 2, useCORS: true });
        const imgData = canvas.toDataURL('image/png');

        // Create PDF with pixel dimensions matching the canvas for best fidelity
        const pdf = new jsPDF({ unit: 'px', format: [canvas.width, canvas.height] });
        pdf.addImage(imgData, 'PNG', 0, 0, canvas.width, canvas.height);
        pdf.save(filename);

        if (created && element && element.parentNode) element.parentNode.removeChild(element);
        return;
      } catch (err) {
        // capture failed (CORS or rendering issue). Clean up and fall back to print window below
        if (created && element && element.parentNode) element.parentNode.removeChild(element);
        // continue to fallback
      }
    }
  }

  // Fallback: open printable window so user can Save as PDF
  const html = isString ? source : element?.outerHTML;
  if (!html) return;

  // remove created element before opening the print window to avoid duplication
  if (created && element && element.parentNode) element.parentNode.removeChild(element);

  const win = window.open('', '_blank');
  if (!win) return;

  const styles = Array.from(document.querySelectorAll('link[rel="stylesheet"], style'))
    .map((n) => n.outerHTML)
    .join('\n');

  win.document.write(`<!doctype html><html><head><meta charset="utf-8"><title>${filename}</title>${styles}</head><body>${html}</body></html>`);
  win.document.close();
  win.focus();

  setTimeout(() => {
    win.print();
  }, 500);
}
