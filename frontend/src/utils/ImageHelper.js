export function getImagemUrl(imagem) {
  if (!imagem) return null

  if (imagem.startsWith('http://') || imagem.startsWith('https://')) {
    return imagem
  }

  return `${import.meta.env.VITE_API_BASE_URL}/storage/produtos/${imagem}`
}