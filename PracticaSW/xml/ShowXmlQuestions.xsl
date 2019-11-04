<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
<html>
	<body>
		<table border="2">
			<thead bgcolor="violet">
			<tr>
				<th>Autor</th><th>Enunciado</th><th>Respuesta Correcta</th><th>Respuestas Incorrectas</th><th>Tema</th>
			</tr>

			</thead>

			<xsl:for-each select="/assessmentItems/assessmentItem">

				<tr bgcolor="lightblue">
					<td ><xsl:value-of select="@author"/></td>

					<td bgcolor="white"><xsl:value-of select="itemBody/p"/></td>
						
					<td bgcolor="lightgreen"><xsl:value-of select="correctResponse/value"/></td>
						
					<td bgcolor="red">
						<ul>
							<xsl:for-each select="incorrectResponses/value">
								<li>
									<xsl:value-of select="."/><br/>
								</li>
							</xsl:for-each>
						</ul>
					</td>
					<td><xsl:value-of select="@subject"/> </td>
				</tr>

			</xsl:for-each>
		</table>
	</body>
</html>
</xsl:template>
</xsl:stylesheet>